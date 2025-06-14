<?php
session_start();

// Generate CSRF token if not already set
// if (!isset($_SESSION['csrf_token'])) {
//     $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
// }

// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "rms-database"; 

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
// Check if 'id' is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the delete statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM applications WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Successfully deleted 
        header('Location: /RMS-Project/pages/view_applications.php?msg=deleted'); 
        echo '<script>
    
        setTimeout(function() { 
            window.location.href = "/RMS-Project/pages/view_applications.php";
        }, 1000);
        </script>';
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid ID.";
}

$conn->close();
?>
