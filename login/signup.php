<?php
// Database connection
  include("../includes/db.php"); 


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST;

    $name = trim($input['name'] ?? '');
    $email = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';
    $confirm_password = $input['confirm_password'] ?? '';
    $role = trim($input['role'] ?? '');

    // Basic validation
   // Basic validation
$errors = [];

if (empty($name)) $errors[] = "Name is required.";
if (empty($email)) $errors[] = "Email is required.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
if (empty($password)) $errors[] = "Password is required.";
if ($password !== $confirm_password) $errors[] = "Passwords do not match.";
if (empty($role)) $errors[] = "Role is required.";

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
    exit;
}


    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Check if email already exists
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "<p style='color:red;'>Email already exists. Please use another one.</p>";
    exit;
}
$check->close();
    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
    

    if ($stmt->execute()) {
        // echo "Signup successful!";
        // Optionally redirect:
        header("Location: /RMS-Project/login/");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
