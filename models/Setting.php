<?php
// models/Setting.php
// Manages retrieval and modifications of global site configuration parameters

class Setting {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Retrieve all key-value pairs of settings
     * @return array
     */
    public function get_all_settings() {
        try {
            $stmt = $this->db->query("SELECT setting_key, setting_value FROM site_settings");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $settings = [];
            foreach ($results as $row) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
            return $settings;
        } catch (PDOException $e) {
            error_log("Error in get_all_settings: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Update or Insert a configuration parameter safely
     * @param string $key
     * @param string|null $value
     * @return bool
     */
    public function update_setting($key, $value) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO site_settings (setting_key, setting_value) 
                VALUES (:key, :value) 
                ON DUPLICATE KEY UPDATE setting_value = :value_update
            ");
            return $stmt->execute([
                ':key' => $key,
                ':value' => $value,
                ':value_update' => $value
            ]);
        } catch (PDOException $e) {
            error_log("Error in update_setting for key '$key': " . $e->getMessage());
            return false;
        }
    }
}
