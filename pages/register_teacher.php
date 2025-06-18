<?php
// Database configuration
$host = 'localhost';
$dbname = 'rms-database';
$username = 'root';
$password = '';

// Response array
$response = array();

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if form was submitted via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Get and sanitize form data
        $full_name = trim($_POST['full_name'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $teacher_phone = trim($_POST['phone'] ?? '');
        $qualification = trim($_POST['qualification'] ?? '');
        $experience = intval($_POST['experience'] ?? 0);
        $class_assigned = trim($_POST['class_assigned'] ?? '');
        
        // Validation
        $errors = array();
        
        // Validate full name
        if (empty($full_name)) {
            $errors[] = "Full name is required";
        } elseif (strlen($full_name) < 2) {
            $errors[] = "Full name must be at least 2 characters long";
        }
        
        // Validate subject
        $valid_subjects = ['Mathematics', 'Physics', 'Chemistry', 'Biology', 'English', 
                          'Kinyarwanda', 'French', 'History', 'Geography', 'Computer Science', 'Physical Education'];
        if (empty($subject)) {
            $errors[] = "Subject specialization is required";
        } elseif (!in_array($subject, $valid_subjects)) {
            $errors[] = "Invalid subject specialization";
        }
        
        // Validate email
        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        } else {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM teachers WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = "Email already exists";
            }
        }
        
        // Validate phone number
        if (empty($teacher_phone)) {
            $errors[] = "Phone number is required";
        } elseif (!preg_match('/^\+250\s?[0-9]{9}$/', $teacher_phone)) {
            $errors[] = "Invalid phone number format (use +250 format)";
        }
        
        // Validate qualification
        $valid_qualifications = ['Bachelor\'s Degree', 'Master\'s Degree', 'PhD', 'Diploma'];
        if (empty($qualification)) {
            $errors[] = "Qualification is required";
        } elseif (!in_array($qualification, $valid_qualifications)) {
            $errors[] = "Invalid qualification";
        }
        
        // Validate experience
        if ($experience < 0 || $experience > 50) {
            $errors[] = "Years of experience must be between 0 and 50";
        }
        
        // If no errors, insert into database
        if (empty($errors)) {
            try {
                // Generate teacher ID
                $teacher_id = 'T' . date('Y') . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
                
                // Check if teacher_id already exists (rare case)
                $stmt = $pdo->prepare("SELECT id FROM teachers WHERE teacher_id = ?");
                $stmt->execute([$teacher_id]);
                while ($stmt->fetch()) {
                    $teacher_id = 'T' . date('Y') . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
                    $stmt->execute([$teacher_id]);
                }
                
                // Insert teacher record
                $sql = "INSERT INTO teachers (teacher_id, full_name, subject_specialization, email, phone, qualification, years_experience,class_assigned, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?, ?,?, NOW())";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$teacher_id, $full_name, $subject, $email, $teacher_phone, $qualification, $experience,$class_assigned]);
                
                $response['status'] = 'success';
                $response['message'] = 'Teacher registered successfully!';
                $response['teacher_id'] = $teacher_id;
                
                // Log the registration
                error_log("New teacher registered: $full_name (ID: $teacher_id)");
                
            } catch (PDOException $e) {
                $response['status'] = 'error';
                $response['message'] = 'Database error: Unable to register teacher';
                error_log("Database error in register_teacher.php: " . $e->getMessage());
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Validation errors';
            $response['errors'] = $errors;
        }
        
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid request method';
    }
    
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Database connection failed';
    error_log("Database connection error in register_teacher.php: " . $e->getMessage());
}

// Return JSON response for AJAX requests
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// For regular form submissions, redirect with message
if ($response['status'] == 'success') {
    header("Location: admin.php?message=" . urlencode($response['message']) . "&type=success");
    // Redirect to teachers page with success message
    // header("Location: teachers.php?message=" . urlencode($response['message']) . "&type=success");
} else {
    // Redirect back with error message
    $error_message = $response['message'];
    if (isset($response['errors'])) {
        $error_message .= ': ' . implode(', ', $response['errors']);
    }
    header("Location: admin.php?message=" . urlencode($error_message) . "&type=error");
}
exit;  
 