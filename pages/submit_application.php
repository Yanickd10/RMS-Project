<?php
// Database configuration
  include("../includes/db.php"); 

// Create uploads directory if it doesn't exist
$upload_dir = "uploads/";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form fields
    $fullname = sanitize_input($_POST["fullname"]);
    $email = sanitize_input($_POST["email"]);
    $phone = sanitize_input($_POST["phone"]);
    $level = sanitize_input($_POST["level"]);
    $message = isset($_POST["message"]) ? sanitize_input($_POST["message"]) : "";
    
    // Validate required fields
    if (empty($fullname) || empty($email) || empty($phone) || empty($level)) {
        echo "Error: All required fields must be filled out";
        exit();
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format";
        exit();
    }
    
    // Initialize variable to store file paths
    $file_paths = [];
    $upload_status = true;
    $error_message = "";
    // Process file uploads
    if (isset($_FILES["documents"]) && !empty($_FILES["documents"]["name"][0])) {
        $total_files = count($_FILES["documents"]["name"]);
        
        // Loop through each file
        for ($i = 0; $i < $total_files; $i++) {
            if ($_FILES["documents"]["error"][$i] == 0) {
                $file_name = $_FILES["documents"]["name"][$i];
                $file_tmp = $_FILES["documents"]["tmp_name"][$i];
                $file_size = $_FILES["documents"]["size"][$i];
                $file_type = $_FILES["documents"]["type"][$i];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                // Check file extension
                $allowed_ext = ["pdf", "jpg", "jpeg", "png", "zip"];
                if (!in_array($file_ext, $allowed_ext)) {
                    $upload_status = false;
                    $error_message = "Error: Only PDF, JPG, PNG, and ZIP files are allowed";
                    break;
                }
                
                // Check file size (limit to 5MB)
                if ($file_size > 5000000) {
                    $upload_status = false;
                    $error_message = "Error: File size must be less than 5MB";
                    break;
                }
                
                // Generate unique filename to prevent overwriting
                $new_file_name = uniqid('doc_') . '.' . $file_ext;
                $destination = $upload_dir . $new_file_name;
                
                // Move uploaded file to destination
                if (move_uploaded_file($file_tmp, $destination)) {
                    $file_paths[] = $destination;
                } else {
                    $upload_status = false;
                    $error_message = "Error: There was a problem uploading your file";
                    break;
                }
            } else {
                $upload_status = false;
                $error_message = "Error: File upload failed with error code " . $_FILES["documents"]["error"][$i];
                break;
            }
        }
    }
    
    // If file uploads were successful, proceed to save to database
    if ($upload_status) {
        try {
            // Connect to database
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Prepare SQL statement for application table
            $stmt = $conn->prepare("INSERT INTO applications (fullname, email, phone, level, message, submission_date) 
                                   VALUES (:fullname, :email, :phone, :level, :message, NOW())");
            
            // Bind parameters
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':level', $level);
            $stmt->bindParam(':message', $message);
            
            // Execute query
            $stmt->execute();
            
            // Get the last inserted application ID
            $application_id = $conn->lastInsertId();
            
            // If files were uploaded, store their paths in the database
            if (!empty($file_paths)) {
                $stmt_files = $conn->prepare("INSERT INTO application_documents (application_id, file_path) VALUES (:application_id, :file_path)");
                
                foreach ($file_paths as $path) {
                    $stmt_files->bindParam(':application_id', $application_id);
                    $stmt_files->bindParam(':file_path', $path);
                    $stmt_files->execute();
                }
            }
            
            // Success message
            $response = [
                'status' => true,
                'message' => 'Your application has been submitted successfully!'
            ];
         
            echo  '<script>window.alert("Your application has been submitted successfully!");</script>';
            header( 'Location: /RMS-Project/pages/academics.php');  
            exit();
        } catch(PDOException $e) {
            // Error handling for database connection/query
            $response = [
                'status' => 'error',
                'message' => 'Database Error: ' . $e->getMessage()
            ];
            
            // Clean up uploaded files in case of database error
            foreach ($file_paths as $path) {
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        
        $conn = null; // Close connection
    } else {
        // Send error response for file upload issues
        $response = [
            'status' => 'error',
            'message' => $error_message
        ];
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // If someone tries to access this file directly without submitting the form
    header("Location: index.php");
    exit();
}
?>