<?php
  include("../includes/db.php"); 

// Fetch applications data
$sql = "SELECT * FROM applications ORDER BY submission_date DESC";
$result = $conn->query($sql);
?>
<?php
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'deleted':
            echo "<p style='color:green;'>Record deleted successfully.</p>";
            break;
        case 'error':
            echo "<p style='color:red;'>Error deleting the record.</p>";
            break;
        case 'csrf_error':
            echo "<p style='color:red;'>Security error. Please refresh and try again.</p>";
            break;
        case 'invalid':
            echo "<p style='color:red;'>Invalid request.</p>";
            break;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applications</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-responsive {
            overflow-x: auto;
        }

        .status-approved {
            color: #198754;
            font-weight: 500;
        }

        .status-pending {
            color: #fd7e14;
            font-weight: 500;
        }

        .status-rejected {
            color: #dc3545;
            font-weight: 500;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }
        .table{
            min-width: 800px;
            /* table-layout: fixed; */ 
        }
        .actions{
            align-items: center; 
            width:20%; 
            background-color: cyan; 
        }
        @media screen and (max-width: 768px) {
            .actions {
                width: 40%;
                display: flex;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Student Applications</h1>
            <div>
                <!-- <a href="#" class="btn btn-success me-2">Export CSV</a> -->
                <a href="admin" class="btn btn-primary">Go to Dashborad</a>
            </div>
        </div>

        <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive rounded-3 shadow-sm">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Names</th>
                        <!-- <th scope="col">Position</th> -->
                        <!-- <th scope="col">Email</th> -->
                        <th scope="col">Phone</th>
                        <th scope="col">Level</th>
                        <th scope="col">Date</th>
                        <th scope="col">Message</th>
                        <th class="actions"  scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        while($row = $result->fetch_assoc()): 
                        ?>
                    <?php
                            // Determine status class
                            // $statusClass = 'status-pending';
                            // if ($row['status'] == 'Approved') $statusClass = 'status-approved';
                            // elseif ($row['status'] == 'Rejected') $statusClass = 'status-rejected';
                            ?>
                    <tr>
                        
                        <!-- <td><?php 
                        // echo $i; 
                        ?></td> -->
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['fullname']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['level']) ?></td>
                        <td><?= date('M d, Y', strtotime($row['submission_date'])) ?></td>
                        <td><?= htmlspecialchars($row['message']) ?></td>
                        <td
                            style="align-items: center;   display: flex; justify-content: space-evenly;">

                            <button class="btn btn-sm btn-outline-danger" onclick="location.href='delete_application.php?id=<?= $row['id'] ?>'">Delete</button>
                            <button class="btn btn-sm btn-outline-primary" onclick="location.href='applicant_details.php?id=<?= $row['id'] ?>'">View Documment</button>
                        </td>
                    </tr>
                     
                    <?php 
                        $i++;
                    endwhile;
                     ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="alert alert-info mt-4">
            <h4 class="alert-heading">No applications found!</h4>
            <p>There are currently no applications in the system.</p>
        </div>
        <?php endif; ?>

        <div class="mt-4 text-muted text-center">
            <p>Total Applications: <strong><?= $result->num_rows ?></strong></p>
        </div>
    </div>
     <script>
// JavaScript confirmation dialog
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this application?")) {
        // If confirmed, redirect with CSRF token
        const csrfToken = "<?= $_SESSION['csrf_token'] ?>";
        window.location.href = `delete_application.php?id=${id}&token=${csrfToken}`;
    }
}
</script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php 
// Close connection
$conn->close();
?>