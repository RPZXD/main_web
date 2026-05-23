<?php
// config/database.php
// Database connection class using PDO for secure transactions

class Database {
    private static $host = '127.0.0.1';
    private static $db_name = 'school_db';
    private static $username = 'root';
    private static $password = ''; // Default XAMPP MySQL password is empty
    private static $conn = null;

    /**
     * Connects to the database and returns the PDO instance
     * @return PDO
     */
    public static function connect() {
        if (self::$conn !== null) {
            return self::$conn;
        }

        // Support Docker environment variables if set, otherwise fallback to local configurations
        $dbHost = getenv('DB_HOST') ?: self::$host;
        $dbName = getenv('DB_NAME') ?: self::$db_name;
        $dbUser = getenv('DB_USER') ?: self::$username;
        $dbPass = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : self::$password;

        try {
            self::$conn = new PDO(
                "mysql:host=" . $dbHost . ";dbname=" . $dbName . ";charset=utf8mb4",
                $dbUser,
                $dbPass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            // Write to system error log
            error_log("Database Connection Error: " . $e->getMessage());
            
            // Show a user-friendly message
            header('HTTP/1.1 500 Internal Server Error');
            echo '<div style="font-family: sans-serif; text-align: center; padding: 50px;">';
            echo '<h2 style="color: #e53e3e;">ขออภัย เกิดข้อผิดพลาดทางระบบ</h2>';
            echo '<p>ไม่สามารถเชื่อมต่อฐานข้อมูลได้ในขณะนี้ กรุณาติดต่อผู้ดูแลระบบหรือลองใหม่อีกครั้ง</p>';
            echo '</div>';
            exit();
        }

        return self::$conn;
    }
}
