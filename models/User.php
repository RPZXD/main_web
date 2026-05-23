<?php
// models/User.php
// Handles administration database interactions for user details

class User {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Authenticates administrator / personnel
     * @param string $username
     * @param string $password
     * @return array|false
     */
    public function authenticate($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Clear password hash from array before returning
                unset($user['password']);
                return $user;
            }
        } catch (PDOException $e) {
            error_log("User authentication database error: " . $e->getMessage());
        }
        return false;
    }

    /**
     * Retrieve user profile details by ID
     * @param int $id
     * @return array|false
     */
    public function findById($id) {
        try {
            $stmt = $this->db->prepare("SELECT id, username, fullname, role, created_at FROM users WHERE id = :id LIMIT 1");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("User profile query error: " . $e->getMessage());
        }
        return false;
    }
}
