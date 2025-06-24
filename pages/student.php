 <?php
// Database connection and data fetching would go here
// For demonstration, using sample data arrays

// Sample assignments data (replace with database query)
$assignments = [
    [
        'id' => 1,
        'title' => 'Calculus Problem Set #3',
        'teacher' => 'Dr. Smith',
        'teacher_id' => 1,
        'file_name' => 'calculus_hw3.pdf',
        'file_path' => 'uploads/assignments/calculus_hw3.pdf',
        'file_type' => 'pdf',
        'submitted_date' => '2024-06-20',
        'status' => 'graded',
        'grade' => '92/100',
        'student_id' => 1
    ],
    [
        'id' => 2,
        'title' => 'Physics Lab Report',
        'teacher' => 'Prof. Johnson',
        'teacher_id' => 2,
        'file_name' => 'physics_lab.docx',
        'file_path' => 'uploads/assignments/physics_lab.docx',
        'file_type' => 'docx',
        'submitted_date' => '2024-06-22',
        'status' => 'submitted',
        'grade' => null,
        'student_id' => 1
    ]
];

// Sample notes data (replace with database query)
$notes = [
    [
        'id' => 1,
        'subject' => 'Mathematics',
        'topic' => 'Differential Equations',
        'teacher' => 'Dr. Smith',
        'teacher_id' => 1,
        'file_name' => 'differential_equations.pdf',
        'file_path' => 'uploads/notes/differential_equations.pdf',
        'file_type' => 'pdf',
        'date_added' => '2024-06-15'
    ],
    [
        'id' => 2,
        'subject' => 'Physics',
        'topic' => 'Quantum Mechanics',
        'teacher' => 'Prof. Johnson',
        'teacher_id' => 2,
        'file_name' => 'quantum_mechanics.pdf',
        'file_path' => 'uploads/notes/quantum_mechanics.pdf',
        'file_type' => 'pdf',
        'date_added' => '2024-06-18'
    ],
    [
        'id' => 3,
        'subject' => 'Literature',
        'topic' => 'Shakespeare Analysis',
        'teacher' => 'Ms. Davis',
        'teacher_id' => 3,
        'file_name' => 'shakespeare_notes.docx',
        'file_path' => 'uploads/notes/shakespeare_notes.docx',
        'file_type' => 'docx',
        'date_added' => '2024-06-20'
    ],
    [
        'id' => 4,
        'subject' => 'Chemistry',
        'topic' => 'Organic Reactions',
        'teacher' => 'Mr. Wilson',
        'teacher_id' => 4,
        'file_name' => 'organic_reactions.pdf',
        'file_path' => 'uploads/notes/organic_reactions.pdf',
        'file_type' => 'pdf',
        'date_added' => '2024-06-21'
    ]
];

// Sample teachers data (replace with database query)
$teachers = [
    ['id' => 1, 'name' => 'Dr. Smith', 'subject' => 'Mathematics'],
    ['id' => 2, 'name' => 'Prof. Johnson', 'subject' => 'Physics'],
    ['id' => 3, 'name' => 'Ms. Davis', 'subject' => 'Literature'],
    ['id' => 4, 'name' => 'Mr. Wilson', 'subject' => 'Chemistry'],
    ['id' => 5, 'name' => 'Dr. Brown', 'subject' => 'Biology']
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_assignment'])) {
    $assignment_title = $_POST['assignment_title'] ?? '';
    $teacher_id = $_POST['teacher_id'] ?? '';
    $uploaded_file = $_FILES['assignment_file'] ?? null;
    
    if ($assignment_title && $teacher_id && $uploaded_file && $uploaded_file['error'] === UPLOAD_ERR_OK) {
        // File validation
        $allowed_types = ['pdf', 'doc', 'docx'];
        $file_extension = strtolower(pathinfo($uploaded_file['name'], PATHINFO_EXTENSION));
        
        if (in_array($file_extension, $allowed_types)) {
            // In real implementation, you would:
            // 1. Move uploaded file to secure directory
            // 2. Insert assignment data into database
            // 3. Redirect to prevent re-submission
            
            $success_message = "Assignment submitted successfully!";
        } else {
            $error_message = "Please upload only PDF or Word documents.";
        }
    } else {
        $error_message = "Please fill in all fields and select a file.";
    }
}

// Handle file download
if (isset($_GET['download']) && isset($_GET['file'])) {
    $file_path = $_GET['file'];
    // In real implementation, add security checks here
    // header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    // header('Content-Type: application/octet-stream');
    // readfile($file_path);
    // exit;
}

// Handle file view
if (isset($_GET['view']) && isset($_GET['file'])) {
    $file_path = $_GET['file'];
    // In real implementation, add security checks here
    // Serve file for viewing in browser
}

// Handle assignment deletion
if (isset($_GET['delete_assignment']) && isset($_GET['id'])) {
    $assignment_id = $_GET['id'];
    // In real implementation:
    // 1. Delete file from server
    // 2. Delete record from database
    // 3. Redirect to refresh page
}

function getFileIcon($file_type) {
    switch (strtolower($file_type)) {
        case 'pdf':
            return 'PDF';
        case 'doc':
        case 'docx':
            return 'DOC';
        default:
            return 'FILE';
    }
}

function getStatusClass($status) {
    switch ($status) {
        case 'graded':
            return 'status-graded';
        case 'submitted':
            return 'status-submitted';
        case 'pending':
            return 'status-pending';
        default:
            return 'status-pending';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }

        .header h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 10px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            color: #666;
            font-size: 1.1rem;
        }

        .nav-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
        }

        .nav-tab {
            padding: 15px 30px;
            cursor: pointer;
            border: none;
            background: transparent;
            font-size: 1.1rem;
            font-weight: 600;
            color: #666;
            border-radius: 10px 10px 0 0;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-tab:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .nav-tab.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .upload-section {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            color: white;
        }

        .upload-section h3 {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .upload-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input, .form-group select {
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.2);
            border: 2px dashed rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .file-upload:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.8);
        }

        .file-upload input[type="file"] {
            position: absolute;
            left: -9999px;
        }

        .upload-btn {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
        }

        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            text-align: left;
            font-weight: 600;
            font-size: 1.1rem;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        .action-btn {
            padding: 8px 16px;
            margin: 0 5px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9rem;
        }

        .view-btn {
            background: linear-gradient(45deg, #2196F3, #21CBF3);
            color: white;
        }

        .download-btn {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
        }

        .delete-btn {
            background: linear-gradient(45deg, #f44336, #da190b);
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-submitted {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .status-pending {
            background: #fff3e0;
            color: #f57c00;
        }

        .status-graded {
            background: #e3f2fd;
            color: #1976d2;
        }

        .empty-state {
            text-align: center;
            padding: 50px;
            color: #666;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-icon {
            width: 24px;
            height: 24px;
            background: #667eea;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-weight: 600;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .upload-form {
                grid-template-columns: 1fr;
            }
            
            .nav-tabs {
                flex-wrap: wrap;
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            .action-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
                margin: 2px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 Student Dashboard</h1>
            <p>Manage your assignments and access course notes</p>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <div class="nav-tabs">
            <a href="#assignments" class="nav-tab active" onclick="switchTab(event, 'assignments')">📝 Assignments</a>
            <a href="#notes" class="nav-tab" onclick="switchTab(event, 'notes')">📔 Notes</a>
        </div>

        <!-- Assignments Tab -->
        <div id="assignments" class="tab-content active">
            <div class="upload-section">
                <h3>🚀 Submit New Assignment</h3>
                <form method="POST" enctype="multipart/form-data" class="upload-form">
                    <div class="form-group">
                        <label for="assignment_title">Assignment Title</label>
                        <input type="text" id="assignment_title" name="assignment_title" 
                               placeholder="Enter assignment title" required>
                    </div>
                    <div class="form-group">
                        <label for="teacher_id">Select Teacher</label>
                        <select id="teacher_id" name="teacher_id" required>
                            <option value="">Choose a teacher</option>
                            <?php foreach ($teachers as $teacher): ?>
                                <option value="<?php echo $teacher['id']; ?>">
                                    <?php echo htmlspecialchars($teacher['name'] . ' - ' . $teacher['subject']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upload File (PDF/Word)</label>
                        <div class="file-upload" onclick="document.getElementById('assignment_file').click()">
                            <div id="fileUploadText">📎 Click to select file or drag & drop</div>
                            <input type="file" id="assignment_file" name="assignment_file" 
                                   accept=".pdf,.doc,.docx" onchange="handleFileSelect(this)">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit_assignment" class="upload-btn">Submit Assignment</button>
                    </div>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Assignment</th>
                            <th>Teacher</th>
                            <th>File</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Grade</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($assignments)): ?>
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <p>No assignments submitted yet.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($assignments as $assignment): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($assignment['title']); ?></td>
                                    <td><?php echo htmlspecialchars($assignment['teacher']); ?></td>
                                    <td>
                                        <div class="file-info">
                                            <div class="file-icon"><?php echo getFileIcon($assignment['file_type']); ?></div>
                                            <span><?php echo htmlspecialchars($assignment['file_name']); ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($assignment['submitted_date']); ?></td>
                                    <td>
                                        <span class="status-badge <?php echo getStatusClass($assignment['status']); ?>">
                                            <?php echo ucfirst($assignment['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $assignment['grade'] ? htmlspecialchars($assignment['grade']) : '-'; ?></td>
                                    <td>
                                        <a href="?view=1&file=<?php echo urlencode($assignment['file_path']); ?>" 
                                           class="action-btn view-btn" target="_blank">View</a>
                                        <a href="?download=1&file=<?php echo urlencode($assignment['file_path']); ?>" 
                                           class="action-btn download-btn">Download</a>
                                        <a href="?delete_assignment=1&id=<?php echo $assignment['id']; ?>" 
                                           class="action-btn delete-btn" 
                                           onclick="return confirm('Are you sure you want to delete this assignment?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notes Tab -->
        <div id="notes" class="tab-content">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Topic</th>
                            <th>Teacher</th>
                            <th>File</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($notes)): ?>
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <p>No notes available yet.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($notes as $note): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($note['subject']); ?></td>
                                    <td><?php echo htmlspecialchars($note['topic']); ?></td>
                                    <td><?php echo htmlspecialchars($note['teacher']); ?></td>
                                    <td>
                                        <div class="file-info">
                                            <div class="file-icon"><?php echo getFileIcon($note['file_type']); ?></div>
                                            <span><?php echo htmlspecialchars($note['file_name']); ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($note['date_added']); ?></td>
                                    <td>
                                        <a href="?view=1&file=<?php echo urlencode($note['file_path']); ?>" 
                                           class="action-btn view-btn" target="_blank">View</a>
                                        <a href="?download=1&file=<?php echo urlencode($note['file_path']); ?>" 
                                           class="action-btn download-btn">Download</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function switchTab(event, tabName) {
            event.preventDefault();
            
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.nav-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to selected tab
            event.target.classList.add('active');
        }

        function handleFileSelect(input) {
            const file = input.files[0];
            const fileUploadText = document.getElementById('fileUploadText');
            
            if (file) {
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                fileUploadText.innerHTML = `📎 ${file.name} (${fileSize} MB)`;
            } else {
                fileUploadText.innerHTML = '📎 Click to select file or drag & drop';
            }
        }

        // Add drag and drop functionality
        document.addEventListener('DOMContentLoaded', function() {
            const fileUpload = document.querySelector('.file-upload');
            
            fileUpload.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.background = 'rgba(255, 255, 255, 0.3)';
                this.style.borderColor = 'rgba(255, 255, 255, 0.8)';
            });
            
            fileUpload.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.style.background = 'rgba(255, 255, 255, 0.2)';
                this.style.borderColor = 'rgba(255, 255, 255, 0.5)';
            });
            
            fileUpload.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.background = 'rgba(255, 255, 255, 0.2)';
                this.style.borderColor = 'rgba(255, 255, 255, 0.5)';
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    document.getElementById('assignment_file').files = files;
                    handleFileSelect(document.getElementById('assignment_file'));
                }
            });
        });
    </script>
</body>
</html>