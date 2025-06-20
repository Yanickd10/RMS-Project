<?php
  include("../includes/db.php"); 
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if form was submitted via POST
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_name = $_POST['class_name'];
    $total_students = $_POST['total_students'];
    $class_teacher = $_POST['class_teacher'];
                // Insert teacher record
                $sql = "INSERT INTO classes (class_name, total_students, class_teacher) VALUES (?, ?, ?)";
                         
                
          $stmt = $pdo->prepare($sql);
if ($stmt->execute([$class_name, $total_students, $class_teacher])) {
    echo "success";
} else {
    echo "database error";
}
    }?>