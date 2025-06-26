<?php
include("../includes/db.php");
// Validate and sanitize id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $application_id = intval($_GET['id']);

    // Fetch document path
    $stmt = $conn->prepare("SELECT file_path FROM application_documents WHERE id = ?"); 

    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $stmt->bind_result($file_path);
    $stmt->fetch();
    $stmt->close();

    if ($file_path) {
        // Display PDF
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Application Document</title>
        </head>
        <body>
            <h2>Document for Application ID: User<?= $application_id ?></h2> 
             <iframe src="/RMS-Project/pages/<?php echo(htmlspecialchars($file_path));?>" type="application/pdf"  width="100%" height="800px"></iframe>
        </body>
        </html>
        <?php
    } else {
        echo "Document not found.";
    }
} else {
    echo "Invalid Application ID.";
}

$conn->close();
?>
