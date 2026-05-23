<?php
// models/News.php
// Interacts with `news` table for retrieving and changing school news postings

class News {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Retrieves all news records
     * @param string|null $category filter by news category ('general', 'activity', 'announcement')
     * @param int|null $limit max amount of posts
     * @return array
     */
    public function getAll($category = null, $limit = null) {
        try {
            $sql = "SELECT n.*, u.fullname as author_name FROM news n 
                    LEFT JOIN users u ON n.created_by = u.id";
            
            $params = [];
            if ($category) {
                $sql .= " WHERE n.category = :category";
                $params['category'] = $category;
            }
            
            $sql .= " ORDER BY n.created_at DESC";
            
            if ($limit) {
                // Ensure limit is sanitised for SQL injection safety as parameter placeholders in LIMIT clauses
                // can sometimes behave inconsistently based on database engines
                $sql .= " LIMIT " . (int)$limit;
            }

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("News database query error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Retrieves a single news post by ID
     * @param int $id
     * @return array|false
     */
    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT n.*, u.fullname as author_name FROM news n 
                                        LEFT JOIN users u ON n.created_by = u.id 
                                        WHERE n.id = :id LIMIT 1");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("News details query error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Inserts a new news record
     * @param array $data keys: title, content, category, image_url, attachment_pdf, created_by, created_at
     * @return bool
     */
    public function create($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO news (title, content, category, image_url, attachment_pdf, doc_number, budget, created_by, created_at) 
                                         VALUES (:title, :content, :category, :image_url, :attachment_pdf, :doc_number, :budget, :created_by, :created_at)");
            return $stmt->execute([
                'title' => $data['title'],
                'content' => $data['content'],
                'category' => $data['category'],
                'image_url' => $data['image_url'] ?? null,
                'attachment_pdf' => $data['attachment_pdf'] ?? null,
                'doc_number' => $data['doc_number'] ?? null,
                'budget' => isset($data['budget']) && $data['budget'] !== '' ? (float)$data['budget'] : null,
                'created_by' => $data['created_by'],
                'created_at' => $data['created_at'] ?? date('Y-m-d H:i:s')
            ]);
        } catch (PDOException $e) {
            error_log("Create news post error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Updates an existing news post
     * @param int $id
     * @param array $data keys: title, content, category, (optional) image_url, (optional) attachment_pdf, (optional) created_at
     * @return bool
     */
    public function update($id, $data) {
        try {
            $sql = "UPDATE news SET title = :title, content = :content, category = :category";
            $params = [
                'id' => $id,
                'title' => $data['title'],
                'content' => $data['content'],
                'category' => $data['category']
            ];
            
            if (isset($data['image_url'])) {
                $sql .= ", image_url = :image_url";
                $params['image_url'] = $data['image_url'];
            }

            if (isset($data['attachment_pdf'])) {
                $sql .= ", attachment_pdf = :attachment_pdf";
                $params['attachment_pdf'] = $data['attachment_pdf'];
            }

            if (isset($data['doc_number'])) {
                $sql .= ", doc_number = :doc_number";
                $params['doc_number'] = $data['doc_number'];
            }

            if (isset($data['budget'])) {
                $sql .= ", budget = :budget";
                $params['budget'] = isset($data['budget']) && $data['budget'] !== '' ? (float)$data['budget'] : null;
            }

            if (isset($data['created_at'])) {
                $sql .= ", created_at = :created_at";
                $params['created_at'] = $data['created_at'];
            }
            
            $sql .= " WHERE id = :id";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Update news post error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Deletes a news post
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM news WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("Delete news post error: " . $e->getMessage());
            return false;
        }
    }
}
