<?php
// if (!defined('BASE_PATH')) {
//     die('Direct access not allowed');
// }
?>

<?php
// Prevent direct access
if (!defined('SECURE_ACCESS')) {
    http_response_code(403);
    exit('Access denied');
}
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<!-- Security headers -->
<meta http-equiv="X-Content-Type-Options" content="nosniff">
<meta http-equiv="X-Frame-Options" content="DENY">
<meta http-equiv="X-XSS-Protection" content="1; mode=block">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<link rel="icon" style=" border-radius: 50%;" href="/RMS-Project/assets/images/logo.jpg" type="image/x-icon">

<meta name="keywords"
    content="Rukara Model School,RMS,Model School, About Us, School History, Administration Team, Staff Profiles">
<meta name="description"
    content="About Us - Learn more about our school's history, administration team, and staff profiles.">
<!-- Add your CSS links here -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/nav.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Add other head elements here -->