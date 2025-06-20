<?php
$host = 'localhost';
$dbname = 'rms-database';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch class names from the `classes` table
    $classQuery = $pdo->query("SELECT class_name FROM classes");
    $classList = $classQuery->fetchAll(PDO::FETCH_COLUMN);

    $classCounts = [];

    foreach ($classList as $className) {
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM students WHERE class = ?");
        $stmt->execute([$className]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $classCounts[$className] = $row['total'];
    }

    echo json_encode($classCounts);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
