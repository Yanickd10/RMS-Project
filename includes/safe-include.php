<?php
class SafeInclude {
    private static $allowedIncludes = [
        'header-links.php',
        'navigation.php', 
        'main-page.php',
        'footer.php',
        'back-to-top.php'
    ];
    
    public static function includeFile($filename) {
        if (!in_array($filename, self::$allowedIncludes)) {
            error_log("Attempted to include unauthorized file: $filename");
            return false;
        }
        
        $filepath = INCLUDES_PATH . '/' . $filename;
        
        if (!file_exists($filepath) || !is_readable($filepath)) {
            error_log("File not found or not readable: $filepath");
            return false;
        }
        
        include $filepath;
        return true;
    }
}
?>