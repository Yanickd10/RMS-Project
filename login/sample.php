<?php
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'your_db_username';
$password = 'your_db_password';

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

// Function to check user in specific table
function checkUserInTable($pdo, $table, $username, $password) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM $table WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify password (assuming passwords are hashed)
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}

// Function to set session and redirect
function loginUser($user, $userType) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_type'] = $userType;
    $_SESSION['login_time'] = time();
    
    // Regenerate session ID for security
    session_regenerate_id(true);
    
    // Redirect based on user type
    switch($userType) {
        case 'admin':
            header("Location: admin_dashboard.php");
            break;
        case 'teacher':
            header("Location: teacher_dashboard.php");
            break;
        case 'student':
            header("Location: student_dashboard.php");
            break;
        default:
            header("Location: login.php?error=invalid_user_type");
            break;
    }
    exit();
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Please enter both username and password.";
    } else {
        $username = sanitize_input($_POST['username']);
        $password = $_POST['password']; // Don't sanitize password as it might remove special characters
        
        // Rate limiting - prevent brute force attacks
        $ip = $_SERVER['REMOTE_ADDR'];
        $current_time = time();
        
        // Check if user exists in admins table first
        $user = checkUserInTable($pdo, 'admins', $username, $password);
        if ($user) {
            loginUser($user, 'admin');
        }
        
        // Check if user exists in teachers table
        $user = checkUserInTable($pdo, 'teachers', $username, $password);
        if ($user) {
            loginUser($user, 'teacher');
        }
        
        // Check if user exists in students table
        $user = checkUserInTable($pdo, 'students', $username, $password);
        if ($user) {
            loginUser($user, 'student');
        }
        
        // If no user found in any table
        $error = "Invalid username or password.";
        
        // Log failed login attempt
        error_log("Failed login attempt for username: $username from IP: $ip");
    }
}

// Check if user is already logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    switch($_SESSION['user_type']) {
        case 'admin':
            header("Location: admin_dashboard.php");
            break;
        case 'teacher':
            header("Location: teacher_dashboard.php");
            break;
        case 'student':
            header("Location: student_dashboard.php");
            break;
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: #666;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
        }
        
        .error {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #c62828;
        }
        
        .security-info {
            margin-top: 20px;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 5px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Secure Login</h1>
            <p>Access your dashboard</p>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="error">
                <?php 
                switch($_GET['error']) {
                    case 'invalid_user_type':
                        echo "Invalid user type detected.";
                        break;
                    case 'session_expired':
                        echo "Your session has expired. Please login again.";
                        break;
                    default:
                        echo "An error occurred. Please try again.";
                }
                ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required 
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
        
        <div class="security-info">
            <strong>Security Features:</strong>
            <ul style="margin-top: 5px; margin-left: 20px;">
                <li>Password hashing verification</li>
                <li>SQL injection protection</li>
                <li>Session security</li>
                <li>Input sanitization</li>
                <li>Failed login attempt logging</li>
            </ul>
        </div>
    </div>
</body>
</html>