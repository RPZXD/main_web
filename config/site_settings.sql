-- config/site_settings.sql
-- Create and Seed site_settings Table for Dynamic Configurations

CREATE TABLE IF NOT EXISTS `site_settings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `setting_key` VARCHAR(100) UNIQUE NOT NULL,
    `setting_value` TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Default Settings
INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('school_name', 'โรงเรียนพิชัย'),
('school_name_en', 'Phichai School'),
('school_short_name', 'พช.'),
('school_address_th', 'โรงเรียนพิชัย 123 ถนนพิชัย อำเภอเมือง จังหวัดลำปาง 52000'),
('school_address_en', 'Phichai School, 123 Phichai Road, Mueang District, Lampang 52000'),
('school_phone', '054-123456'),
('school_fax', '054-654321'),
('school_email', 'contact@school.ac.th'),
('school_facebook', 'https://facebook.com/phichaischool'),
('school_youtube', 'https://youtube.com/phichaischool'),
('school_line', 'https://line.me/R/ti/p/@phichaischool'),
('school_logo', ''),
('school_favicon', ''),
('google_map_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3780.27453303666!2d99.5050853761053!3d18.286121482759942!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30d96fe875e533e7%3A0xc3cb7217db55d7f8!2z4LmC4Lih4Lii4LmA4Lij4Li14Lii4LiZ4Lie4Li04LiK4Lix4Lii!5e0!3m2!1sth!2sth!4v1716480000000!5m2!1sth!2sth')
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);
