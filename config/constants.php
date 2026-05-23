<?php
// config/constants.php
// Define System Constants and Configurations

// Dynamically determine the Base URL relative to server root
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';

// Get base directory of entry point index.php (inside public)
$baseDir = str_replace('\\', '/', dirname($scriptName));
if (substr($baseDir, -1) !== '/') {
    $baseDir .= '/';
}

define('BASE_URL', $protocol . '://' . $host . $baseDir);

// Portals & Educational System Links for Navigation
define('PORTAL_SGS', 'https://sgs.obec.go.th/');
define('PORTAL_DMC', 'https://dmc.bopp-obec.info/');
define('PORTAL_OBEC', 'https://www.obec.go.th/');
define('PORTAL_EMIS', 'https://emis.obec.go.th/');
define('PORTAL_GPA', 'https://gpa.obec.go.th/');

// Root Paths for Internal Directory Access
define('ROOT_PATH', dirname(__DIR__) . '/');
define('UPLOAD_DIR', ROOT_PATH . 'public/uploads/');
define('ASSETS_URL', BASE_URL . 'assets/');
define('UPLOAD_URL', BASE_URL . 'uploads/');
