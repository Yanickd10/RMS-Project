 <?php
session_start(); // Start session at the top

$conn = new mysqli("localhost", "root", "", "rms-database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Tables to check (you can add 'teachers', 'students' later)
    $tables = ['admins'];
    $user = null;
    $role = '';

    foreach ($tables as $table) {
        $stmt = $conn->prepare("SELECT * FROM $table WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Check hashed password
            if (password_verify($password, $user['password'])) {
                $role = $table;
                break;
            } else {
                $user = null; // Password does not match
            }
        }
    }

    // If user authenticated
    if ($user) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['names'] = $user['names']; // Ensure column name is 'names'
        $_SESSION['role'] = $role;
        header("Location: /RMS-Project/pages/admin");
        exit;
    } else {
        echo "<script> alert('Invalid email or password.  Or you are not Authorised to use this system'); location.href = '/RMS-Project/login/';</script>";
    }
}
?>
