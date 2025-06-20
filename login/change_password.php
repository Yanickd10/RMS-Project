 <?php
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'rms-database';
$username = 'root';
$password = '';

// Create PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to find user in any table and return table name
function findUserByEmail($pdo, $email) {
    $tables = ['admins',];// add other tables to check
    
    foreach ($tables as $table) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM $table WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                return ['user' => $user, 'table' => $table];
            }
        } catch(PDOException $e) {
            error_log("Database error: " . $e->getMessage());
        }
    }
    return false;
}

// Function to update password in specific table
function updatePassword($pdo, $table, $email, $newPassword) {
    try {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE $table SET password = :password WHERE email = :email");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    } catch(PDOException $e) {
        error_log("Password update error: " . $e->getMessage());
        return false;
    }
}

// Process password change form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are provided
    if (empty($_POST['email']) || empty($_POST['currentpassword']) || empty($_POST['newpassword'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=empty_fields");
        exit();
    }
    
    $email = sanitize_input($_POST['email']);
    $currentPassword = $_POST['currentpassword'];
    $newPassword = $_POST['newpassword'];
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=invalid_email");
        exit();
    }
    
    // Validate new password strength
    if (strlen($newPassword) < 6) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=weak_password");
        exit();
    }
    
    // Find user in database
    $userResult = findUserByEmail($pdo, $email);
    
    if (!$userResult) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=user_not_found");
        exit();
    }
    
    $user = $userResult['user'];
    $table = $userResult['table'];
    
    // Verify current password
    // Since current passwords are now hashed, we use password_verify
    if (!password_verify($currentPassword, $user['password'])) {
        // Log failed attempt
        error_log("Failed password change attempt for email: $email - incorrect current password");
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=incorrect_current_password");
        exit();
    }
    
    // Check if new password is different from current
    if (password_verify($newPassword, $user['password'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=same_password");
        exit();
    }
    
    // Update password with hashed version
    if (updatePassword($pdo, $table, $email, $newPassword)) {
        // Log successful password change
        error_log("Password successfully changed for email: $email in table: $table");
        
        // If this is the current logged-in user, update session
        if (isset($_SESSION['email']) && $_SESSION['email'] === $email) {
            // Force re-login for security
            session_destroy();
            echo "<script>
                if(confirm('Password changed successfully! You will be redirected to login page.')) {
                    location.href = '/RMS-Project/login/';
                }
            </script>";
            exit();
        }
        
        echo "<script>
            alert('Password changed successfully!');
            window.history.back();
        </script>";
        exit();
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=update_failed");
        exit();
    }
}

// Handle GET request (if someone accesses directly)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['email'])) {
        $email = sanitize_input($_GET['email']);
        
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=invalid_email");
            exit();
        }
        
        // Check if user exists
        $userResult = findUserByEmail($pdo, $email);
        if (!$userResult) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=user_not_found");
            exit();
        }
        
        // Redirect back to form (this handles the button click)
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// If accessed without proper data, redirect to referrer or home
header("Location: " . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php'));
exit();
?>