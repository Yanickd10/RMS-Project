<?php
// Load security configuration
require_once 'config/security.php';
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Home | Rukara Model SChool</title>

    <?php secure_include('header-links.php'); ?> 
</head>
<body>
    <?php secure_include('navigation.php'); ?>
    <?php
 $page = $_GET['page'] ?? 'main-page.php';

if ($page === 'main-page.php') {
    $pageTitle = 'Home';
    secure_include($page, 'include');
} else {
    $pageTitle = ucfirst(str_replace('.php', '', $page)); // e.g. "About"
    if (!secure_include($page, 'page')) {
        $pageTitle = "Page Not Found";
        echo "<p>Page not found or unauthorized.</p>";
    }
}?>


    <?php secure_include('footer.php'); ?>  
    <?php secure_include('back-to-top.php'); ?>
 
   <?php if (!defined('SECURE_ACCESS')) { die('Restricted access'); } ?>
    <!-- Secure script loading with defer attribute -->
    <script src="assets/js/index.js" defer></script>
    <script src="assets/js/nav.js" defer></script>
    <script src="assets/js/smooth-scroll.js" defer></script>
</body>
</html>