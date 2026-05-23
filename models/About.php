<?php
// models/About.php
// Manages database interactions for static school details and administrative directories

class About {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Retrieves specific school info section by key (e.g. 'history')
     * @param string $key
     * @return array|false
     */
    public function getSection($key) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM school_info WHERE section_key = :key LIMIT 1");
            $stmt->execute(['key' => $key]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("About school info query error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Retrieves all seeded school info sections mapped by key
     * @return array
     */
    public function getAllSections() {
        try {
            $stmt = $this->db->query("SELECT * FROM school_info");
            $rows = $stmt->fetchAll();
            $sections = [];
            foreach ($rows as $row) {
                $sections[$row['section_key']] = $row;
            }
            return $sections;
        } catch (PDOException $e) {
            error_log("All school info query error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Retrieves the school executives directory list
     * @return array
     */
    public function getExecutives() {
        try {
            // Sort by order_num ascending
            $stmt = $this->db->query("SELECT * FROM school_executives ORDER BY order_num ASC");
            $rows = $stmt->fetchAll();

            // If there are seeded executives, return them
            if (!empty($rows)) {
                return $rows;
            }

            // Fallback: use teacher table from shared phichaia_student database
            // Map commonly-used teacher columns to the executives view shape
            $fallbackSql = "SELECT Teach_id, Teach_name, Teach_Position2, Teach_photo, Teach_email, Teach_Academic FROM phichaia_student.teacher WHERE Teach_status = 1 ORDER BY Teach_Position2 IS NULL, Teach_Position2 LIMIT 100";
            $fbStmt = $this->db->query($fallbackSql);
            $teachers = $fbStmt->fetchAll();

            $executives = [];
            foreach ($teachers as $i => $t) {
                $image = '';
                if (!empty($t['Teach_photo'])) {
                    // Common public URL used across the workspace for teacher photos
                    $image = 'https://std.phichai.ac.th/teacher/uploads/phototeach/' . ltrim($t['Teach_photo'], '/');
                }

                $executives[] = [
                    'id' => $t['Teach_id'] ?? null,
                    'name_th' => $t['Teach_name'] ?? '',
                    'name_en' => $t['Teach_name'] ?? '',
                    'position_th' => $t['Teach_Position2'] ?? '',
                    'position_en' => $t['Teach_Position2'] ?? '',
                    'period' => null,
                    'image_path' => $image,
                    'academic_rank' => $t['Teach_Academic'] ?? '',
                    'email' => $t['Teach_email'] ?? '',
                    'is_current' => 1,
                    'order_num' => $i + 1,
                ];
            }

            return $executives;
        } catch (PDOException $e) {
            error_log("School executives list query error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Updates specific school info section content
     * @param string $key
     * @param string $contentTh
     * @param string $contentEn
     * @return bool
     */
    public function updateSection($key, $contentTh, $contentEn) {
        try {
            $stmt = $this->db->prepare("UPDATE school_info SET content_th = :content_th, content_en = :content_en WHERE section_key = :key");
            return $stmt->execute([
                'content_th' => $contentTh,
                'content_en' => $contentEn,
                'key' => $key
            ]);
        } catch (PDOException $e) {
            error_log("Update school info error: " . $e->getMessage());
            return false;
        }
    }
}
