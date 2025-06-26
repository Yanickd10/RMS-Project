<?php
// config/security.php - Main security configuration

// Define security constant
if (!defined('SECURE_ACCESS')) {
    define('SECURE_ACCESS', true);
}

// Security settings for production
error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Define allowed include files (whitelist)
define('ALLOWED_INCLUDES', [
    'header-links.php',
    'navigation.php',
    'main-page.php',
    'footer.php',
    'back-to-top.php'
]);

// Define allowed page files (for standalone pages)
define('ALLOWED_PAGES', [
    'about.php', 
    'academics.php',
    'news.php'
    // Add other page files here
]);

/**
 * Safely include files with security checks
 * @param string $file - filename to include
 * @param string $type - 'include' for includes/, 'page' for pages/
 * @return bool - success status
 */
 function secure_include($file, $type = 'include') {
    $filename = basename($file);

    if ($type === 'include') {
        $allowed_files = ALLOWED_INCLUDES;
        $target_dir = __DIR__ . '/../includes/';
    } elseif ($type === 'page') {
        $allowed_files = ALLOWED_PAGES;
        $target_dir = __DIR__ . '/../pages/';
    } else {
        error_log("Security Alert: Invalid include type - " . $type);
        return false;
    }

    if (!in_array($filename, $allowed_files)) {
        error_log("Security Alert: Unauthorized include attempt - " . $file . " from IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        return false;
    }

    $file_path = $target_dir . $filename;

    if (!file_exists($file_path) || !is_readable($file_path)) {
        error_log("Error: Include file not found or not readable - " . $file_path);
        return false;
    }

    $real_path = realpath($file_path);
    $real_target_dir = realpath($target_dir);

    if (strpos($real_path, $real_target_dir) !== 0) {
        error_log("Security Alert: Directory traversal attempt - " . $file . " from IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        return false;
    }

    include $file_path;
    return true;
}


/**
 * Sanitize output to prevent XSS
 * @param string $string - string to sanitize
 * @return string - sanitized string
 */
function safe_output($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>