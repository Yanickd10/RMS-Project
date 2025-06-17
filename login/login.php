

<?php
// $_SESSION['logged_in'] === true;
session_start(); // Start a session to store login state

// DB connection
$host = 'localhost';
$dbname = 'rms-database';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>Email and password are required.</p>";
        exit;
    }

    // Get user from database
    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($userId, $userName, $hashedPassword, $userRole);
        $stmt->fetch();

        // Verify password
      if (password_verify($password, $hashedPassword)) {
    // Store user info in session
    session_regenerate_id(true); // For better security
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_name'] = $userName;
    $_SESSION['user_role'] = $userRole;
    
    // Redirect based on role
    if ($userRole === 'admin') {
        header("Location: /RMS-Project/pages/admin.php");
        exit;
    } elseif ($userRole === 'teacher') {
        header("Location: /RMS-Project/pages/teacher");
        exit;
    } elseif ($userRole === 'student') {
        header("Location: /RMS-Project/pages/student-portal");
        exit;
    } else {
        echo "<p style='color:red;'>Unknown role.</p>";
    }
     $stmt->close();
    }
}
}
$conn->close();
?>
