<?php
include("../includes/db.php"); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classId = $_POST['class_id'];
    $file = $_FILES['assignment_file'];

    // Create uploads folder if it doesn't exist
    $uploadDir = '../uploads/assignments/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = basename($file['name']);
    $targetFile = $uploadDir . time() . '_' . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO `teacher-resources` (class_id, file_path, upload_date) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $classId, $targetFile);
        if ($stmt->execute()) {
            echo "Uploaded successfully. <button onclick=\"window.location.href='teacher'\">Ok</button>";

        } else {
            echo "Error saving to database: " . $stmt->error;
        }
    } else {
        echo "Failed to upload file.";
    }
}
?>
