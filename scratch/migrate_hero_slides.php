<?php
// scratch/migrate_hero_slides.php
// Creates `hero_slides` table and seeds default slides

require_once dirname(__DIR__) . '/config/database.php';

try {
    $db = Database::connect();
    
    // Create hero_slides table
    $db->exec("CREATE TABLE IF NOT EXISTS `hero_slides` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `title` VARCHAR(255) DEFAULT NULL,
      `image_url` VARCHAR(255) NOT NULL,
      `display_order` INT NOT NULL DEFAULT 0,
      `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    
    echo "Table 'hero_slides' created or already exists.\n";
    
    // Check if table is empty, if so, seed default slides
    $stmt = $db->query("SELECT COUNT(*) FROM `hero_slides`");
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        $db->exec("INSERT INTO `hero_slides` (`title`, `image_url`, `display_order`, `status`) VALUES
        ('สไลด์โรงเรียนที่ 1', 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1600&auto=format&fit=crop', 1, 'active'),
        ('สไลด์โรงเรียนที่ 2', 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1600&auto=format&fit=crop', 2, 'active'),
        ('สไลด์โรงเรียนที่ 3', 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1600&auto=format&fit=crop', 3, 'active')");
        echo "Default slides seeded successfully.\n";
    } else {
        echo "Table already has records. Seeding skipped.\n";
    }
    
    echo "Migration completed successfully!\n";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
    exit(1);
}
