<?php
  include("../includes/db.php"); 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if class_name is passed
    if (isset($_GET['class_name'])) {
        $className = $_GET['class_name'];

        // Get all students in that class
        $stmt = $pdo->prepare("SELECT * FROM students WHERE class = :class ORDER BY full_name ASC");
        $stmt->execute(['class' => $className]);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        die("Class name not provided.");
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Class - <?= htmlspecialchars($className) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f8fa;
            color: #333;
        }
        .container {
            /* max-width: 1100px; */
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #0b5394;
        }
        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 16px;
            background: #0b5394;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #083b6f;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #0b5394;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f6fa;
        }

        tr:hover {
            background-color:rgb(189, 190, 192);
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                display: none;
            }
            td {
                position: relative;
                padding-left: 50%;
                border: none;
                border-bottom: 1px solid #ccc;
            }
            td::before {
                position: absolute;
                top: 12px;
                left: 15px;
                width: 45%;
                white-space: nowrap;
                font-weight: bold;
                content: attr(data-label);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a class="btn-back" href="admin.php">&larr; Back</a>

        <h2>Students in Class: <?= htmlspecialchars($className) ?></h2>

        <?php if (!empty($students)): ?>
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <?php foreach (array_keys($students[0]) as $col): ?>
                                <th><?= htmlspecialchars(ucwords(str_replace('_', ' ', $col))) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr >
                                <?php foreach ($student as $key => $value): ?>
                                    <td data-label="<?= htmlspecialchars(ucwords(str_replace('_', ' ', $key))) ?>">
                                        <?= htmlspecialchars($value) ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No students found in class <strong><?= htmlspecialchars($className) ?></strong>.</p>
        <?php endif; ?>
    </div>
</body>
</html>