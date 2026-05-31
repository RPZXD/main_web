<?php
// models/Ita.php
// Handles database operations for Integrity and Transparency Assessment (ITA) items

class Ita {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Get all ITA items (O1 to O43)
     * Sorted naturally using the digit part of the code (O1, O2, ..., O43)
     * @param string|null $status filter by publication status ('published', 'draft')
     * @return array
     */
    public function getAll($status = null) {
        try {
            $sql = "SELECT * FROM ita_items";
            $params = [];
            
            if ($status) {
                $sql .= " WHERE status = :status";
                $params['status'] = $status;
            }
            
            // Order naturally by parsing O part away. In standard SQL, cast after substring.
            // E.g. code is 'O15', SUBSTRING(code, 2) is '15', cast as unsigned -> 15
            $sql .= " ORDER BY CAST(SUBSTRING(code, 2) AS UNSIGNED) ASC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $rows = $stmt->fetchAll();
            foreach ($rows as &$row) {
                if (isset($row['file_path'])) {
                    $row['file_path'] = clean_db_url($row['file_path']);
                }
            }
            return $rows;
        } catch (PDOException $e) {
            error_log("ITA items database query error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get an ITA item by its specific code (e.g. O1, O23)
     * @param string $code
     * @return array|false
     */
    public function getByCode($code) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM ita_items WHERE code = :code LIMIT 1");
            $stmt->execute(['code' => $code]);
            $row = $stmt->fetch();
            if ($row && isset($row['file_path'])) {
                $row['file_path'] = clean_db_url($row['file_path']);
            }
            return $row;
        } catch (PDOException $e) {
            error_log("ITA item by code query error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Updates an ITA indicator link, upload file path, or name
     * @param string $code
     * @param array $data keys: name, link_url, file_path, status
     * @return bool
     */
    public function update($code, $data) {
        try {
            $stmt = $this->db->prepare("UPDATE ita_items SET 
                                        name = :name, 
                                        link_url = :link_url, 
                                        file_path = :file_path, 
                                        status = :status 
                                        WHERE code = :code");
            return $stmt->execute([
                'code' => $code,
                'name' => $data['name'],
                'link_url' => $data['link_url'],
                'file_path' => $data['file_path'],
                'status' => $data['status']
            ]);
        } catch (PDOException $e) {
            error_log("Update ITA item database error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Computes the progress of published and completed indicators
     * Completed indicators are those with either a link_url or a file_path
     * @return array containing total count and completed count
     */
    public function getMetrics() {
        try {
            $stmt = $this->db->prepare("SELECT 
                                        COUNT(*) as total,
                                        SUM(CASE WHEN (link_url IS NOT NULL AND TRIM(link_url) != '') 
                                                   OR (file_path IS NOT NULL AND TRIM(file_path) != '') 
                                                 THEN 1 ELSE 0 END) as completed
                                        FROM ita_items WHERE status = 'published'");
            $stmt->execute();
            $result = $stmt->fetch();
            
            return [
                'total' => (int)($result['total'] ?? 43),
                'completed' => (int)($result['completed'] ?? 0)
            ];
        } catch (PDOException $e) {
            error_log("ITA progress metrics query error: " . $e->getMessage());
            return ['total' => 43, 'completed' => 0];
        }
    }
}
