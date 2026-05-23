<?php
// scratch/migrate_settings.php
// Temporary script to migrate site settings table structure and seed values

require_once dirname(__DIR__) . '/config/database.php';

try {
    $db = Database::connect();
    
    // Read SQL script
    $sql = file_get_contents(dirname(__DIR__) . '/config/site_settings.sql');
    
    // Execute SQL script
    $db->exec($sql);
    
    echo "SUCCESS: site_settings table created and seeded successfully!\n";
} catch (Exception $e) {
    echo "ERROR: Migration failed - " . $e->getMessage() . "\n";
}
