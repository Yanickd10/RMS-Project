<?php
  include("../includes/db.php"); 

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if form was submitted via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate and sanitize input data
        $event_name = trim($_POST['event_name'] ?? '');
        $event_type = trim($_POST['event_type'] ?? '');
        $event_date = trim($_POST['event_date'] ?? '');
        $event_time = trim($_POST['event_time'] ?? '');
        $event_location = trim($_POST['event_location'] ?? '');
        $event_description = trim($_POST['event_description'] ?? '');
        $event_participants = trim($_POST['event_participants'] ?? '');
        
        // Basic validation
        $errors = [];
        
        if (empty($event_name)) {
            $errors[] = "Event name is required";
        }
        
        if (empty($event_type)) {
            $errors[] = "Event type is required";
        }
        
        if (empty($event_date)) {
            $errors[] = "Event date is required";
        }
        
        if (empty($event_time)) {
            $errors[] = "Event time is required";
        }
        
        if (empty($event_location)) {
            $errors[] = "Event location is required";
        }
        
        if (empty($event_participants)) {
            $errors[] = "Event participants selection is required";
        }
        
        // If no errors, proceed with database insertion
        if (empty($errors)) {
            try {
                // Prepare SQL statement
                $sql = "INSERT INTO events (event_name, event_type, event_date, event_time, event_location, event_description, event_participants, created_at) 
                        VALUES (:event_name, :event_type, :event_date, :event_time, :event_location, :event_description, :event_participants, NOW())";
                
                $stmt = $pdo->prepare($sql);
                
                // Bind parameters
                $stmt->bindParam(':event_name', $event_name);
                $stmt->bindParam(':event_type', $event_type);
                $stmt->bindParam(':event_date', $event_date);
                $stmt->bindParam(':event_time', $event_time);
                $stmt->bindParam(':event_location', $event_location);
                $stmt->bindParam(':event_description', $event_description);
                $stmt->bindParam(':event_participants', $event_participants);
                
                // Execute the statement
                if ($stmt->execute()) {
                    // Success response
                    $response = [
                        'status' => 'success',
                        'message' => 'Event created successfully!',
                        'event_id' => $pdo->lastInsertId()
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to create event. Please try again.'
                    ];
                }
                
            } catch (PDOException $e) {
                $response = [
                    'status' => 'error',
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            }
        } else {
            // Validation errors
            $response = [
                'status' => 'error',
                'message' => 'Validation errors: ' . implode(', ', $errors),
                'errors' => $errors
            ];
        }
        
        // Check if it's an AJAX request
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            // Return JSON response for AJAX
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // Handle regular form submission
            if ($response['status'] == 'success') {
                // Redirect to events page or show success message
                header('Location: events.php?success=1');
                exit();
            } else {
                // Redirect back with error message
                header('Location: events.php?error=' . urlencode($response['message']));
                exit();
            }
        }
        
    } else {
        // If not POST request, redirect to events page
        header('Location: events.php');
        exit();
    }
    
} catch (PDOException $e) {
    // Database connection error
    $error_message = "Connection failed: " . $e->getMessage();
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => $error_message
        ]);
    } else {
        header('Location: events.php?error=' . urlencode($error_message));
        exit();
    }
}
?>