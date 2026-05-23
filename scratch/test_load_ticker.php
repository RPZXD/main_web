<?php
require_once dirname(__DIR__) . '/config/constants.php';
require_once dirname(__DIR__) . '/config/database.php';

// Autoload Controllers and Models automatically
spl_autoload_register(function ($class) {
    $controllerPath = ROOT_PATH . 'controllers/' . $class . '.php';
    $modelPath = ROOT_PATH . 'models/' . $class . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
    } elseif (file_exists($modelPath)) {
        require_once $modelPath;
    }
});

// Load active scrolling tickers globally
$activeTickers = [];
try {
    $urgentModel = new UrgentNews();
    $activeTickers = $urgentModel->getAll(true);
    echo "ACTIVE TICKERS COUNT: " . count($activeTickers) . "\n";
    print_r($activeTickers);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
