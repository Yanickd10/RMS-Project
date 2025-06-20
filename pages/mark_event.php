<?php
// Database configuration
$host = 'localhost';
$dbname = 'rms-database';
$username = 'root';
$password = '';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get event name from URL
if (isset($_GET['event_name'])) {
    $event_name = $_GET['event_name']; // Do NOT use intval here — it's a string
$stmt = $conn->prepare("UPDATE events SET mark = 'Marked As Done' WHERE event_name = ?");
$stmt->bind_param("s", $event_name);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Event marked as done.";
} else {
    echo "No event was updated.";
}
}?>