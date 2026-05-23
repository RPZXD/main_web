<?php
// scratch/migrate_news_pdf.php
// Script to execute the alter query to add attachment_pdf to news table

require_once dirname(__DIR__) . '/config/database.php';

try {
    $db = Database::connect();
    
    // Execute Alter Query
    $db->exec("ALTER TABLE `news` ADD COLUMN `attachment_pdf` VARCHAR(255) NULL AFTER `image_url` ");
    
    echo "SUCCESS: attachment_pdf column added to news table successfully!\n";
} catch (Exception $e) {
    // If the column already exists, that is fine, let the user know
    if (strpos($e->getMessage(), 'Duplicate column') !== false) {
        echo "INFO: Column attachment_pdf already exists.\n";
    } else {
        echo "ERROR: Migration failed - " . $e->getMessage() . "\n";
    }
}
