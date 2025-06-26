<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #fbbf24;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 600;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 12px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-right: 3px solid #fbbf24;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-section {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: #fbbf24;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
        }

        .top-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notification-btn {
            background: #fbbf24;
            color: white;
        }

        .help-btn {
            background: #10b981;
            color: white;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .welcome-title {
            font-size: 36px;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        /* Stats Section */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .stat-icon.notes {
            background: #6366f1;
        }

        .stat-icon.papers {
            background: #f59e0b;
        }

        .stat-icon.exercises {
            background: #10b981;
        }

        .stat-content h3 {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .stat-content .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
        }

        /* Quick Actions Section */
        .quick-actions {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .action-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-top: 4px solid transparent;
        }

        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .action-card.upload-notes {
            border-top-color: #6366f1;
        }

        .action-card.add-papers {
            border-top-color: #f59e0b;
        }

        .action-card.upload-exercise {
            border-top-color: #10b981;
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .action-icon.upload {
            background: #6366f1;
        }

        .action-icon.papers {
            background: #f59e0b;
        }

        .action-icon.exercise {
            background: #10b981;
        }

        .action-content h4 {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .action-content p {
            color: #6b7280;
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .welcome-title {
                font-size: 28px;
            }

            .stats-section {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 15px;
            }

            .welcome-section {
                padding: 20px;
            }

            .stat-card {
                padding: 20px;
            }

            .action-card {
                padding: 20px;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Modal popup */
        .modal {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.5);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 999;
}

.modal-content {
  background: #fff;
  padding: 30px;
  max-width: 500px;
  width: 90%;
  border-radius: 10px;
  position: relative;
  box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

.close-btn {
  position: absolute;
  top: 10px; right: 15px;
  font-size: 24px;
  cursor: pointer;
}

    </style>
</head>
<body>
    <?php
    // PHP variables for dynamic content
    $teacherName = "Yanich Dushime";
    $totalNotes = 12;
    $pastPapers = 23;
    $exercises = 45;
    ?>

    <div class="dashboard-container">
        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-icon">📚</div>
                <div class="sidebar-title">Teacher Dashboard</div>
            </div>
            
            <nav class="sidebar-nav">
                <a href="#" class="nav-item active">
                    <div class="nav-icon">🏠</div>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-item">
                    <div class="nav-icon">📝</div>
                    <span>Notes</span>
                </a>
                <a href="#" class="nav-item">
                    <div class="nav-icon">📄</div>
                    <span>Past Papers</span>
                </a>
                <a href="#" class="nav-item">
                    <div class="nav-icon">✏️</div>
                    <span>Exercises</span>
                </a>
                <a href="#" class="nav-item">
                    <div class="nav-icon">📚</div>
                    <span>CPD Sessions</span>
                </a>
            </nav>
            <div class="user-section">
                <div class="user-avatar">YD</div>
                <span><?php echo $teacherName; ?></span>
            </div>
        </div>
        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Top Bar -->
            <div class="top-bar">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button class="menu-toggle" id="menuToggle">☰</button>
                    <h1 class="page-title">Dashboard</h1>
                </div>
                <!-- <div class="top-actions"> -->
                    <!-- <button class="action-btn notification-btn" title="Notifications">!</button> -->
                    <!-- <button class="action-btn help-btn" title="Help">?</button> -->
                <!-- </div> -->
            </div>

            <!-- Welcome Section -->
            <div class="welcome-section">
                <h2 class="welcome-title">Welcome back, <?php echo $teacherName; ?>!</h2>
            </div>

            <!-- Stats Section -->
            <div class="stats-section">
                <div class="stat-card">
                    <div class="stat-icon notes">📚</div>
                    <div class="stat-content">
                        <h3>Total Notes</h3>
                        <div class="stat-number"><?php echo $totalNotes; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon papers">📄</div>
                    <div class="stat-content">
                        <h3>Past Papers</h3>
                        <div class="stat-number"><?php echo $pastPapers; ?></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon exercises">✅</div>
                    <div class="stat-content">
                        <h3>Exercises</h3>
                        <div class="stat-number"><?php echo $exercises; ?></div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="quick-actions">
                <h2 class="section-title">Quick Actions</h2>
                <div class="actions-grid">
                    <div class="action-card upload-notes" onclick="handleAction('upload-notes')">
                        <div class="action-icon upload">📚</div>
                        <div class="action-content">
                            <h4>Upload Notes</h4>
                            <p>Share new study materials</p>
                        </div>
                    </div>
                    <div class="action-card add-papers" onclick="handleAction('add-papers')">
                        <div class="action-icon papers">📄</div>
                        <div class="action-content">
                            <h4>Add Past Papers</h4>
                            <p>Upload previous exams</p>
                        </div>
                    </div>
                    <div class="action-card upload-exercise" onclick="handleAction('upload-exercise')">
                        <div class="action-icon exercise">✅</div>
                        <div class="action-content">
                            <h4>Upload Exercise</h4>
                            <p>Give new assignments</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Modal -->
<div id="uploadModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <h3>Upload Assignment</h3>
    <form id="assignmentForm" action="upload_assignment.php" method="POST" enctype="multipart/form-data">
      <label for="class">Select Class:</label>
      <select name="class_id" id="class" required>
        <?php
          include '../db.php'; 
          // Adjust if needed
        //   $result = $conn->query("SELECT id, class_name FROM classes");
        //   while ($row = $result->fetch_assoc()) {
        //     echo "<option value='{$row['id']}'>{$row['class_name']}</option>";
        //   }
        ?>
        <option value="">Select Class</option>
        <option value="">S4MCE</option>
        <option value="">S5PCM</option>

      </select>

      <div id="drop-area" style="border: 2px dashed #ccc; padding: 20px; text-align: center; margin-top: 15px;">
        <p>Drag & Drop file here or click to select</p>
        <input type="file" name="assignment_file" id="fileElem" accept=".pdf,.doc,.docx" style="display:none" required>
        <button type="button" onclick="document.getElementById('fileElem').click()">Choose File</button>
        <p id="fileLabel" style="margin-top: 10px;"></p>
      </div>

      <button type="submit" style="margin-top: 20px; padding: 10px 20px;">Upload</button>
    </form>
  </div>
</div> 


    <script> 
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        });

        // Close sidebar when clicking overlay
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });

        // Navigation item click handler
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all items
                document.querySelectorAll('.nav-item').forEach(nav => {
                    nav.classList.remove('active');
                });
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Close mobile menu
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });

        // Handle quick action clicks
        function handleAction(action) {
            switch(action.trim()) {
                case 'upload-notes':
                    document.getElementById("uploadModal").style.display = "flex";
                    break;
                case 'add-papers':
                    alert('Add Past Papers functionality would be implemented here');
                    break;
                case 'upload-exercise':
                    alert('Upload Exercise functionality would be implemented here');
                    break;
            }
        }

        // Responsive sidebar handling
        function handleResize() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            }
        }

        window.addEventListener('resize', handleResize);

        // Add smooth scrolling for better UX
        document.documentElement.style.scrollBehavior = 'smooth';

        // Add loading animation for stat numbers
        function animateNumbers() {
            const statNumbers = document.querySelectorAll('.stat-number');
            
            statNumbers.forEach(number => {
                const target = parseInt(number.textContent);
                let current = 0;
                const increment = target / 30;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    number.textContent = Math.floor(current);
                }, 50);
            });
        }

        // Trigger animation on page load
        window.addEventListener('load', animateNumbers);

        

  function closeModal() {
    document.getElementById("uploadModal").style.display = "none";
  }

  // Handle file label on selection
  const fileInput = document.getElementById('fileElem');
  const fileLabel = document.getElementById('fileLabel');
  const dropArea = document.getElementById('drop-area');

  if (dropArea && fileInput) {
    dropArea.addEventListener('dragover', e => {
      e.preventDefault();
      dropArea.style.borderColor = '#000';
    });

    dropArea.addEventListener('dragleave', () => {
      dropArea.style.borderColor = '#ccc';
    });

    dropArea.addEventListener('drop', e => {
      e.preventDefault();
      fileInput.files = e.dataTransfer.files;
      fileLabel.textContent = fileInput.files[0].name;
    });

    fileInput.addEventListener('change', () => {
      fileLabel.textContent = fileInput.files[0].name;
    });
  }
    </script>
</body>
</html>