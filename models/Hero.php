<?php
// models/Hero.php
// Interacts with `hero_slides` table for school homepage carousel images

class Hero {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Retrieves all hero slides ordered by display order
     * @param bool $onlyActive If true, returns only active slides
     * @return array
     */
    public function getAll($onlyActive = false) {
        try {
            $sql = "SELECT * FROM hero_slides";
            
            if ($onlyActive) {
                $sql .= " WHERE status = 'active'";
            }
            
            $sql .= " ORDER BY display_order ASC, id DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Hero database query error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Retrieves a single hero slide by ID
     * @param int $id
     * @return array|false
     */
    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM hero_slides WHERE id = :id LIMIT 1");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Hero details query error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inserts a new hero slide
     * @param array $data keys: title, image_url, display_order, status
     * @return bool
     */
    public function create($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO hero_slides (title, image_url, display_order, status) 
                                        VALUES (:title, :image_url, :display_order, :status)");
            return $stmt->execute([
                'title' => $data['title'] ?? null,
                'image_url' => $data['image_url'],
                'display_order' => (int)($data['display_order'] ?? 0),
                'status' => $data['status'] ?? 'active'
            ]);
        } catch (PDOException $e) {
            error_log("Create hero slide error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Updates an existing hero slide
     * @param int $id
     * @param array $data keys: title, (optional) image_url, display_order, status
     * @return bool
     */
    public function update($id, $data) {
        try {
            $sql = "UPDATE hero_slides SET title = :title, display_order = :display_order, status = :status";
            $params = [
                'id' => $id,
                'title' => $data['title'] ?? null,
                'display_order' => (int)($data['display_order'] ?? 0),
                'status' => $data['status'] ?? 'active'
            ];
            
            if (isset($data['image_url'])) {
                $sql .= ", image_url = :image_url";
                $params['image_url'] = $data['image_url'];
            }
            
            $sql .= " WHERE id = :id";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Update hero slide error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Deletes a hero slide
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM hero_slides WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("Delete hero slide error: " . $e->getMessage());
            return false;
        }
    }
}
