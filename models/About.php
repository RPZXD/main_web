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
            $stmt = $this->db->query("SELECT * FROM phichaia_student.teacher WHERE Teach_Position2 = 'ผู้บริหาร' ORDER BY Teach_id ASC");
            return $stmt->fetchAll();
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
