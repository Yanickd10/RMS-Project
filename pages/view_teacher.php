<?php
// Connect to the database
$host = 'localhost';
$dbname = 'rms-database';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get student ID from URL
if (isset($_GET['id'])) {
    $new_id = intval($_GET['id']); // secure the input
    
    $stmt = $conn->prepare("SELECT * FROM teachers WHERE  id = ?");
    $stmt->bind_param("i", $new_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();
    } else {
        echo "<p>Teacher not found.</p>";
        exit;
    }
} else {
    echo "<p>No Teacher ID provided.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $student['full_name'] ?>info</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .card {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px #ccc;
            border-radius: 10px;
        }
        .card h2 {
            text-align: center;
            color: #333;
        }
        .info-table {
            width: 100%;
            margin-top: 20px;
        }
        .info-table td {
            padding: 8px;
            vertical-align: top;
            
        }
        .info-table tr:nth-child(even) {
            background-color:rgb(210, 210, 210);
        }
        .info-table td:first-child {
            font-weight: bold;
            width: 40%;
        }
        .btn {
            cursor: pointer;
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white; 
            text-decoration: none;
            border-radius: 5px;}
    </style>
</head>
<body>

<div class="card">
    <!-- go back button -->
    <a onclick="history.back()" class="btn">Go Back</a>
    <h2>Teacher Full Information</h2>
    <table class="info-table">
        <tr><td>ID:</td><td><?= $student['teacher_id'] ?></td></tr>
        <tr><td>Full Name:</td><td><?= $student['full_name'] ?></td></tr> 
        <tr><td>Class Assigned:</td><td><?= isset($student['class_assigned']) ? htmlspecialchars($student['class_assigned']) : 'Not Assigned' ?></td>
</tr> 
        <tr><td>Contact:</td><td><?= $student['phone'] ?></td></tr> 
        <tr><td>Registered At:</td><td><?= $student['created_at'] ?></td></tr>
        <tr><td>Updated At:</td><td><?= $student['updated_at'] ?></td></tr>
    </table>
</div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

</body>
</html>
