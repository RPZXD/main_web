<?php
// includes/lang_helper.php
// Manages localization states, session switching, and translation string output

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Check if user request switch via GET query param (e.g. ?lang=en)
if (isset($_GET['lang'])) {
    $requestedLang = strtolower(trim($_GET['lang']));
    if (in_array($requestedLang, ['th', 'en'])) {
        $_SESSION['lang'] = $requestedLang;
    }
    
    // Clean query params to prevent URL parameter cluttering
    $cleanUri = strtok($_SERVER['REQUEST_URI'], '?');
    $queryParams = $_GET;
    unset($queryParams['lang']);
    if (!empty($queryParams)) {
        $cleanUri .= '?' . http_build_query($queryParams);
    }
    
    header('Location: ' . $cleanUri);
    exit();
}

// 2. Fetch active language, fallback to Thai if session state is empty
$activeLanguage = $_SESSION['lang'] ?? 'th';

// 3. Load the corresponding dictionary array
$langDictionary = [];
$dictionaryPath = dirname(__DIR__) . "/config/lang_{$activeLanguage}.php";

if (file_exists($dictionaryPath)) {
    $langDictionary = include $dictionaryPath;
}

/**
 * Retrieves the translation string corresponding to the provided key
 * @param string $key
 * @param mixed ...$args values to format (if using printf-style wildcards like %s, %d)
 * @return string
 */
function __($key, ...$args) {
    global $langDictionary;
    $text = $langDictionary[$key] ?? $key;
    
    if (!empty($args)) {
        return vsprintf($text, $args);
    }
    return $text;
}

/**
 * Utility to identify the current active locale ('th' / 'en')
 * @return string
 */
function getActiveLang() {
    global $activeLanguage;
    return $activeLanguage;
}
