<?php
// scratch/migrate_ticker_and_homepage.php
// Upgrades database schema for scrolling news ticker, awards category, procurement fields, and homepage stats/exec settings.

require_once dirname(__DIR__) . '/config/database.php';

try {
    $db = Database::connect();
    
    // 1. Create urgent_news table
    $db->exec("CREATE TABLE IF NOT EXISTS `urgent_news` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `message` TEXT NOT NULL,
      `link_url` VARCHAR(255) DEFAULT NULL,
      `is_active` TINYINT(1) NOT NULL DEFAULT 1,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    echo "Table 'urgent_news' verified.\n";
    
    // Seed default ticker if empty
    $countTicker = $db->query("SELECT COUNT(*) FROM `urgent_news`")->fetchColumn();
    if ($countTicker == 0) {
        $db->exec("INSERT INTO `urgent_news` (`message`, `link_url`, `is_active`) VALUES 
        ('โรงเรียนพิชัยเปิดรับสมัครนักเรียนใหม่ ประจำปีการศึกษา 2569 คลิกดูรายละเอียดระเบียบการที่นี่', 'https://facebook.com/phichaischool', 1),
        ('ขอเชิญผู้ปกครองเข้าร่วมการประชุมใหญ่สามัญประจำปี ในวันที่ 10 มิถุนายน 2569 นี้', NULL, 1)");
        echo "Default urgent tickers seeded.\n";
    }

    // 2. Alter news table (modify category column to include 'award', add doc_number and budget)
    // First check columns to prevent double altering
    $cols = $db->query("SHOW COLUMNS FROM `news`")->fetchAll(PDO::FETCH_COLUMN);
    
    // Modify category to support 'award'
    $db->exec("ALTER TABLE `news` MODIFY COLUMN `category` ENUM('general', 'activity', 'announcement', 'award') NOT NULL DEFAULT 'general';");
    echo "News category column modified to include 'award'.\n";
    
    if (!in_array('doc_number', $cols)) {
        $db->exec("ALTER TABLE `news` ADD COLUMN `doc_number` VARCHAR(100) DEFAULT NULL AFTER `attachment_pdf`;");
        echo "Column 'doc_number' added to news.\n";
    }
    if (!in_array('budget', $cols)) {
        $db->exec("ALTER TABLE `news` ADD COLUMN `budget` DECIMAL(15,2) DEFAULT NULL AFTER `doc_number`;");
        echo "Column 'budget' added to news.\n";
    }
    
    // 3. Seed site_settings table for dynamic stats and exec message
    $defaultSettings = [
        'stat_students' => '1,248',
        'stat_students_sub' => 'เพิ่มขึ้น 4.5% จากปีที่แล้ว',
        'stat_teachers' => '78',
        'stat_teachers_sub' => 'คุณภาพระดับเชี่ยวชาญ',
        'stat_awards' => '156',
        'stat_awards_sub' => 'ระดับชาติและนานาชาติ',
        'stat_admission' => '99.2%',
        'stat_admission_sub' => 'มหาวิทยาลัยชั้นนำ',
        'exec_name' => 'นายสมศักดิ์ ธีระโชติ',
        'exec_position' => 'ผู้อำนวยการสถานศึกษา',
        'exec_message' => 'การศึกษาที่ดีไม่ใช่เพียงการเตรียมเด็กสำหรับการสอบ แต่คือการเตรียมเขาสำหรับชีวิต โรงเรียนพิชัยมุ่งสร้างนักเรียนให้เป็นคนดี คนเก่ง และมีความสุข พร้อมก้าวสู่โลกที่เปลี่ยนแปลงอย่างรวดเร็วด้วยความมั่นใจและเปี่ยมด้วยคุณธรรม',
        'exec_image' => ''
    ];
    
    // Actually, to seed safely without overwriting if already set, we check if key exists first
    foreach ($defaultSettings as $key => $value) {
        $check = $db->prepare("SELECT COUNT(*) FROM `site_settings` WHERE `setting_key` = :key");
        $check->execute(['key' => $key]);
        if ($check->fetchColumn() == 0) {
            $insert = $db->prepare("INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES (:key, :value)");
            $insert->execute(['key' => $key, 'value' => $value]);
            echo "Seeded setting key '{$key}'.\n";
        }
    }
    
    // Let's seed a dummy award news item for preview if none exists
    $stmtAward = $db->prepare("SELECT COUNT(*) FROM `news` WHERE `category` = 'award'");
    $stmtAward->execute();
    if ($stmtAward->fetchColumn() == 0) {
        $db->exec("INSERT INTO `news` (`title`, `content`, `category`, `image_url`, `created_by`, `created_at`) VALUES 
        ('โรงเรียนพิชัยคว้ารางวัลชนะเลิศการแข่งขันหุ่นยนต์เยาวชนระดับประเทศ ประจำปี 2026', 'ความภาคภูมิใจครั้งใหญ่! ทีมเยาวชนโรงเรียนพิชัยชนะเลิศการประกวดสิ่งประดิษฐ์และนวัตกรรมหุ่นยนต์เคลื่อนที่อัตโนมัติ ชิงถ้วยพระราชทานสมเด็จพระกนิษฐาธิราชเจ้า กรมสมเด็จพระเทพรัตนราชสุดาฯ สยามบรมราชกุมารี...', 'award', 'https://images.unsplash.com/photo-1564863130079-81f37e06a1b8?q=80&w=600&auto=format&fit=crop', 1, CURRENT_TIMESTAMP)");
        echo "Seeded dummy award news.\n";
    }

    echo "Database upgrade and migration completed successfully!\n";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
    exit(1);
}
