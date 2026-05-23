<?php
require_once dirname(__DIR__) . '/config/constants.php';
require_once dirname(__DIR__) . '/config/database.php';

try {
    $db = Database::connect();
    $rows = $db->query("SELECT * FROM urgent_news")->fetchAll(PDO::FETCH_ASSOC);
    echo "TICKERS COUNT: " . count($rows) . "\n";
    print_r($rows);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
