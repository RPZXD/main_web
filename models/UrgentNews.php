<?php
// models/UrgentNews.php
// Interacts with `urgent_news` table for scrolling news ticker bar

class UrgentNews {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Retrieves all urgent news tickers
     * @param bool $onlyActive If true, filters by is_active = 1
     * @return array
     */
    public function getAll($onlyActive = false) {
        try {
            $sql = "SELECT * FROM urgent_news";
            if ($onlyActive) {
                $sql .= " WHERE is_active = 1";
            }
            $sql .= " ORDER BY id DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("UrgentNews database query error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Retrieves a single urgent news record by ID
     */
    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM urgent_news WHERE id = :id LIMIT 1");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("UrgentNews getById error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Creates a new urgent news ticker
     */
    public function create($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO urgent_news (message, link_url, is_active) 
                                        VALUES (:message, :link_url, :is_active)");
            return $stmt->execute([
                'message' => $data['message'],
                'link_url' => $data['link_url'] ?? null,
                'is_active' => (int)($data['is_active'] ?? 1)
            ]);
        } catch (PDOException $e) {
            error_log("Create urgent news error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Updates an existing urgent news ticker
     */
    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("UPDATE urgent_news SET message = :message, link_url = :link_url, is_active = :is_active WHERE id = :id");
            return $stmt->execute([
                'id' => $id,
                'message' => $data['message'],
                'link_url' => $data['link_url'] ?? null,
                'is_active' => (int)($data['is_active'] ?? 1)
            ]);
        } catch (PDOException $e) {
            error_log("Update urgent news error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Deletes an urgent news record
     */
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM urgent_news WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("Delete urgent news error: " . $e->getMessage());
            return false;
        }
    }
}
