<?php
// Database configuration
$host = 'localhost';
$dbname = 'rms-database';
$username = 'root';
$password = '';

// Create database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to sanitize input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $fullName = sanitizeInput($_POST['full_name']);
    $dateOfBirth = sanitizeInput($_POST['date_of_birth']);
    $class = sanitizeInput($_POST['class']);
    $parentName = sanitizeInput($_POST['parent_name']);
    $parentContact = sanitizeInput($_POST['parent_contact']);
    // $address = sanitizeInput($_POST['address']);
    $address =  "No address provided";
    
    // Validate required fields
    $errors = [];
    
    if (empty($fullName)) {
        $errors[] = "Full name is required";
    }
    
    if (empty($dateOfBirth)) {
        $errors[] = "Date of birth is required";
    }
    
    if (empty($class)) {
        $errors[] = "Class is required";
    }
    
    if (empty($parentName)) {
        $errors[] = "Parent/Guardian name is required";
    }
    
    if (empty($parentContact)) {
        $errors[] = "Parent contact is required";
    }
    
    // Validate phone number format (basic validation for Rwanda format)
    if (!empty($parentContact) && !preg_match('/^\+?250\s?[0-9]{9}$/', $parentContact)) {
        $errors[] = "Invalid phone number format. Use format: +250 788 000 000";
    }
    
    // Validate date of birth
    if (!empty($dateOfBirth)) {
        $dob = DateTime::createFromFormat('Y-m-d', $dateOfBirth);
        if (!$dob) {
            $errors[] = "Invalid date format";
        } else {
            $today = new DateTime();
            $age = $today->diff($dob)->y;
            if ($age < 5 || $age > 25) {
                $errors[] = "Student age must be between 5 and 25 years";
            }
        }
    }
    
    // If no errors, insert into database
    if (empty($errors)) {
        try {
            $sql = "INSERT INTO students (full_name, date_of_birth, class, parent_name, parent_contact, address, created_at) 
                    VALUES (:full_name, :date_of_birth, :class, :parent_name, :parent_contact, :address, NOW())";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':full_name', $fullName);
            $stmt->bindParam(':date_of_birth', $dateOfBirth);
            $stmt->bindParam(':class', $class);
            $stmt->bindParam(':parent_name', $parentName);
            $stmt->bindParam(':parent_contact', $parentContact);
            $stmt->bindParam(':address', $address);
            
            if ($stmt->execute()) {
                $studentId = $pdo->lastInsertId();
                // echo json_encode([
                //     'status' => 'success',
                //     'message' => 'Student registered successfully!',
                //     'student_id' => $studentId
                // ]);
                header("Location: /RMS-Project/pages/admin.php");
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to register student'
                ]);
            }
        } catch(PDOException $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Validation errors',
            'errors' => $errors
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}

// Close database connection
$pdo = null;
?>

<!-- 
SQL to create the students table:

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    class VARCHAR(20) NOT NULL,
    parent_name VARCHAR(100) NOT NULL,
    parent_contact VARCHAR(20) NOT NULL,
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-->