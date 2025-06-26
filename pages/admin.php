 <?php
    define('SECURE_ACCESS', true);
    require_once '../config/security.php';
    ?>
 <?php
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        // Not allowed
        //   header("Location: /RMS-Project/login/");
        // exit;
    }
    ?>
 <?php
    if (!isset($_SESSION['email'])) {
        // Not logged in
        header("Location: /RMS-Project/login/");
        exit;
    }
    // Access user info
    $email = $_SESSION['email'];
    $name = $_SESSION['names'];
    $role = $_SESSION['role'];
    ?>

 <?php

    // Optional: Block access if not logged in
    // if (!isset($_SESSION['user_id'])) {
    //     header("Location: /RMS-Project/login/");
    //     exit;
    // }

    // Access the name and role
    // $userName = $_SESSION['user_name'];
    // $userRole = $_SESSION['user_role'];
    ?>
 <!-- Retieving the student info -->
 <?php
    include("../includes/db.php");

    // Fetch applications data
    $sql = "SELECT * FROM students ORDER BY id ASC";
    $result = $conn->query($sql);
    // Fetch teachers data
    $teacher_sql = "SELECT * FROM teachers ORDER BY id ASC";
    $teacher_result = $conn->query($teacher_sql);
    // Fetch classes data
    $classes_sql = "SELECT * FROM classes ORDER BY id ASC";
    $classes_result = $conn->query($classes_sql);
    // Fetch classes data for the second table
    $classes2_sql = "SELECT * FROM classes ORDER BY class_name ASC";
    $classes2_result = $conn->query($classes2_sql);
    ?>
 <!-- Retrieving the events info -->
 <?php
    $events_sql = "SELECT * FROM events order by event_date desc";
    $events_result = $conn->query($events_sql);
    ?>
 <?php
    $sum = "SELECT AVG(total_students) AS total_students_sum FROM classes";
    $total_result = $conn->query($sum);

    if ($total_result->num_rows > 0) {
        $row = $total_result->fetch_assoc();
        $total = $row['total_students_sum'];
    }
    ?>
 <!DOCTYPE html>
 <html lang="en-US">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php secure_include('header-links.php'); ?>
     <title>Rukara Model School - Administration</title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link
         href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400..700&family=Purple+Purse&display=swap"
         rel="stylesheet">
     <style>
         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
         }

         body {
             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
             background: linear-gradient(135deg, rgb(102, 232, 234) 0%, rgb(212, 237, 240) 100%);
             min-height: 100vh;
         }

         .header {
             background: rgba(255, 255, 255, 0.95);
             backdrop-filter: blur(10px);
             padding: 1rem 2rem;
             box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
             position: sticky;
             top: 0;
             z-index: 100;
         }

         .header-content {
             display: flex;
             justify-content: space-between;
             align-items: center;
             max-width: 1400px;
             margin: 0 auto;
         }

         .logo {
             display: flex;
             align-items: center;
             gap: 1rem;
         }

         .logo h1 {
             color: #2d3748;
             font-size: 1.8rem;
             font-weight: 700;
         }

         .logo h1 a {
             text-decoration: none;
             color: inherit;
         }

         .admin-info {
             font-weight: 600;
             font-family: "Noto Naskh Arabic", serif;
             display: flex;
             align-items: center;
             gap: 1rem;
             color: #4a5568;
         }

         .sidebar {
             z-index: 99;
             position: fixed;
             left: 0;
             top: 80px;
             width: 280px;
             height: calc(100vh - 80px);
             background: rgba(218, 212, 212, 0.81);
             backdrop-filter: blur(10px);
             padding: 2rem 0;
             overflow-y: auto;
             transition: all 0.3s ease;
         }

         .nav-item {
             display: flex;
             align-items: center;
             padding: 1rem 2rem;
             color: #4a5568;
             text-decoration: none;
             transition: all 0.3s ease;
             cursor: pointer;
             border-left: 4px solid transparent;
         }

         .nav-item:hover,
         .nav-item.active {
             background: rgba(102, 126, 234, 0.6);
             color: rgb(49, 49, 50);
             border-left-color: rgb(245, 0, 0);
         }

         .nav-item span {
             margin-left: 1rem;
             font-weight: 500;
         }

         .main-content {
             margin-left: 280px;
             padding: 2rem;
             max-width: calc(100vw - 280px);
         }

         .content-section {
             display: none;
             animation: fadeIn 0.5s ease;
         }

         .content-section.active {
             display: block;
         }

         @keyframes fadeIn {
             from {
                 opacity: 0;
                 transform: translateY(20px);
             }

             to {
                 opacity: 1;
                 transform: translateY(0);
             }
         }

         .dashboard-grid {
             display: grid;
             grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
             gap: 2rem;
             margin-bottom: 2rem;
         }

         .card {
             background: rgba(255, 255, 255, 0.95);
             backdrop-filter: blur(10px);
             border-radius: 20px;
             padding: 2rem;
             box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
             transition: all 0.3s ease;
             cursor: pointer;
             /* z-index: -1; */
         }

         .card:hover {
             transform: translateY(-5px);
             box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
         }

         .stat-card {
             text-align: center;
             background: linear-gradient(135deg, #667eea, #764ba2);
             color: white;
         }

         .stat-number {
             font-size: 3rem;
             font-weight: 700;
             margin-bottom: 0.5rem;
         }

         .stat-label {
             font-size: 1.1rem;
             opacity: 0.9;
         }

         h2 {
             color: #2d3748;
             margin-bottom: 1.5rem;
             font-size: 1.8rem;
         }

         .form-group {
             margin-bottom: 1.5rem;
         }

         label {
             display: block;
             color: #4a5568;
             font-weight: 600;
             margin-bottom: 0.5rem;
         }

         input,
         textarea,
         select {
             width: 100%;
             padding: 0.75rem 1rem;
             border: 2px solid #e2e8f0;
             border-radius: 10px;
             font-size: 1rem;
             transition: all 0.3s ease;
         }

         input:focus,
         textarea:focus,
         select:focus {
             outline: none;
             border-color: #667eea;
             box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
         }

         .btn {
             background: linear-gradient(135deg, #667eea, #764ba2);
             color: white;
             border: none;
             padding: 0.75rem 2rem;
             border-radius: 10px;
             font-size: 1rem;
             font-weight: 600;
             cursor: pointer;
             transition: all 0.3s ease;
         }

         .btn:hover {
             transform: translateY(-2px);
             box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
         }

         .btn-danger {
             background: linear-gradient(135deg, #fc8181, #f56565);
         }

         .btn-success {
             background: linear-gradient(135deg, #68d391, #48bb78);
         }

         .table {
             width: 100%;
             border-collapse: collapse;
             margin-top: 1rem;
         }

         .table th,
         .table td {
             padding: 1rem;
             text-align: left;
             border-bottom: 1px solid #e2e8f0;
         }

         .table th {
             background: #f7fafc;
             font-weight: 600;
             color: #4a5568;
         }

         .table tr:hover {
             background: #f7fafc;
         }

         .action-buttons {
             display: flex;
             gap: 0.5rem;
         }

         .btn-sm {
             padding: 0.5rem 1rem;
             font-size: 0.875rem;
         }

         .announcement-item {
             background: #f7fafc;
             border-radius: 10px;
             padding: 1.5rem;
             margin-bottom: 1rem;
             border-left: 4px solid #667eea;
         }

         .announcement-date {
             color: #718096;
             font-size: 0.875rem;
             margin-bottom: 0.5rem;
         }

         .announcement-title {
             font-weight: 600;
             color: #2d3748;
             margin-bottom: 0.5rem;
         }

         .modal {
             display: none;
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background: rgba(0, 0, 0, 0.5);
             z-index: 1000;
         }

         .modal-content {
             position: absolute;
             top: 50%;
             left: 50%;
             transform: translate(-50%, -50%);
             background: white;
             border-radius: 20px;
             padding: 2rem;
             max-width: 500px;
             width: 90%;
             max-height: 80vh;
             overflow-y: auto;
         }

         .close {
             position: absolute;
             top: 1rem;
             right: 1rem;
             font-size: 1.5rem;
             cursor: pointer;
             color: #718096;
         }

         .sidebar-toggle {
             display: none;
             background: none;
             border: none;
             font-size: 1.5rem;
             cursor: pointer;
             padding: 0.5rem;
             margin-right: 1rem;
             color: #2d3748;
         }

         .sidebar.collapsed {
             transform: translateX(-100%);
         }

         .main-content.expanded {
             margin-left: 0;
             max-width: 100%;
         }

         @media (max-width: 768px) {
             .sidebar-toggle {
                 display: block;
             }

             .sidebar {
                 transform: translateX(-100%);
             }

             .sidebar.active {
                 transform: translateX(0);
             }

             .main-content {
                 margin-left: 0;
                 max-width: 100%;
             }

             .sidebar {
                 transform: translateX(-100%);
             }

             .main-content {
                 margin-left: 0;
                 max-width: 100vw;
             }

             .dashboard-grid {
                 grid-template-columns: 1fr;
             }
         }
     </style>
 </head>

 <body>
     <?php include("../includes/progress-bar.php"); ?>

     <header class="header">
         <div class="header-content">
             <!-- <div class="logo">
                <h1><a href="/RMS-Project/">Rukara Model School</a></h1>
            </div> -->
             <div class="admin-info">
                 <span>Welcome, </span> <span id="adminName"> <?php echo $name; ?></span>
                 <span>|</span>
                 <span id="currentDate"></span>
             </div>
         </div>
         <div class="header-content">
             <div class="logo">
                 <button id="sidebarToggle" class="sidebar-toggle">
                     ☰
                 </button>
                 <h1><a href="/RMS-Project/">Rukara Model School</a></h1>
             </div>
     </header>
     <nav class="sidebar">
         <a href="#" class="nav-item active" onclick="showSection('dashboard')">
             📊 <span>Dashboard</span>
         </a>
         <a href="#" class="nav-item" onclick="location.href='/RMS-Project/pages/view_applications.php'">
             📚 <span>View applications</span>
         </a>
         <a href="#" class="nav-item" onclick="showSection('announcements')">
             📢 <span>Announcements</span>
         </a>
         <a href="#" class="nav-item" onclick="showSection('students')">
             👥 <span>Students</span>
         </a>
         <a href="#" class="nav-item" onclick="showSection('teachers')">
             👨‍🏫 <span>Teachers</span>
         </a>
         <a href="#" class="nav-item" onclick="showSection('classes')">
             🏛️ <span>Classes</span>
         </a>
         <a href="#" class="nav-item" onclick="showSection('events')">
             📅 <span>Events</span>
         </a>
         <a href="#" class="nav-item" onclick="showSection('advertisements')">
             📺 <span>Announce</span>
         </a>
         <a href="#" class="nav-item" onclick="showSection('reports')">
             📈 <span>Reports</span>
         </a>
         <a href="#" class="nav-item" onclick="showSection('settings')">
             ⚙️ <span>Settings</span>
         </a>
         <a href="#" class="nav-item" onclick="logout()">
             🚪 <span>Logout</span>
         </a>
     </nav>

     <main class="main-content">
         <!-- Dashboard Section -->
         <section id="dashboard" class="content-section active">
             <h2>📊 Dashboard Overview</h2>
             <div class="dashboard-grid">
                 <div onclick="showSection('students')" class="card stat-card">
                     <div class="stat-number"><?= $result->num_rows ?></div>
                     <div class="stat-label">Total Students</div>
                 </div>
                 <div class="card stat-card" onclick="showSection('teachers')">
                     <div class="stat-number"><?= $teacher_result->num_rows ?></div>
                     <div class="stat-label">Teachers</div>
                 </div>
                 <div class="card stat-card" onclick="showSection('classes')">
                     <div class="stat-number"><?= $classes_result->num_rows ?></div>
                     <div class="stat-label">Classes</div>
                 </div>
                 <div style="display: none;" class="card stat-card">
                     <div class="stat-number">0</div>
                     <div class="stat-label">Active Events</div>
                 </div>
             </div>

             <div class="dashboard-grid">
                 <div class="card">
                     <h3>📢 Recent Announcements</h3>
                     <div class="announcement-item">
                         <div class="announcement-date">June 3, 2025</div>
                         <div class="announcement-title">Term Examination Schedule Released</div>
                         <p>The schedule for end-of-term examinations has been published...</p>
                     </div>
                     <div class="announcement-item">
                         <div class="announcement-date">June 1, 2025</div>
                         <div class="announcement-title">Sports Day Postponed</div>
                         <p>Due to weather conditions, Sports Day has been rescheduled...</p>
                     </div>
                 </div>

                 <div class="card">
                     <h3>🎯 Quick Actions</h3>
                     <button class="btn" style="width: 100%; margin-bottom: 1rem;"
                         onclick="showModal('addStudentModal')">➕ Add New Student</button>
                     <button class="btn" style="width: 100%; margin-bottom: 1rem;"
                         onclick="showModal('addTeacherModal')">👨‍🏫 Add New Teacher</button>
                     <button class="btn" style="width: 100%;margin-bottom: 1rem;"
                         onclick="showModal('createClassModal')">📅 Create Class</button>
                     <button class="btn" style="width: 100%; margin-bottom: 1rem;"
                         onclick="showModal('announcementModal')">📢 Make Announcement</button>
                     <button class="btn" style="width: 100%;" onclick="showModal('eventModal')">📅 Create Event</button>
                 </div>
             </div>
         </section>
         <!-- Announcements Section -->
         <section id="announcements" class="content-section">
             <h2>📢 Announcements Management</h2>
             <div class="card">
                 <button class="btn" onclick="showModal('announcementModal')" style="margin-bottom: 1rem;">➕ New
                     Announcement</button>
                 <div id="announcementsList">
                     <div class="announcement-item">
                         <div class="announcement-date">June 3, 2025</div>
                         <div class="announcement-title">Term Examination Schedule Released</div>
                         <p>The schedule for end-of-term examinations has been published. Students should check their
                             respective class notice boards for detailed timing and subject arrangements.</p>
                         <div class="action-buttons" style="margin-top: 1rem;">
                             <button class="btn btn-sm">✏️ Edit</button>
                             <button class="btn btn-sm btn-danger">🗑️ Delete</button>
                         </div>
                     </div>

                     <div class="announcement-item">
                         <div class="announcement-date">June 1, 2025</div>
                         <div class="announcement-title">Sports Day Postponed</div>
                         <p>Due to weather conditions, Sports Day has been rescheduled to June 15, 2025. All
                             participants
                             will be notified of the new arrangements.</p>
                         <div class="action-buttons" style="margin-top: 1rem;">
                             <button class="btn btn-sm">✏️ Edit</button>
                             <button class="btn btn-sm btn-danger">🗑️ Delete</button>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
         <?php if ($result->num_rows > 0): ?>
             <!-- Students Section -->
             <section id="students" class="content-section">
                 <h2>👥 Student Management</h2>
                 <div class="card">
                     <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 1rem;">
                         <button class="btn" onclick="showModal('addStudentModal')">➕ Add Student</button>
                         <input type="text" placeholder="🔍 Search students..." style="width: 300px; margin-left: auto;"
                             onkeyup="searchTable(this, 'studentsTable')">
                     </div>

                     <table class="table" id="studentsTable">
                         <thead>
                             <tr>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Class</th>
                                 <!-- <th>Parent Contact</th> -->
                                 <!-- <th>Status</th> -->
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                while ($row = $result->fetch_assoc()):
                                ?>
                                 <tr>
                                     <td><?= htmlspecialchars($row['id']) ?></td>
                                     <td><?= htmlspecialchars($row['full_name']) ?></td>
                                     <td><?= htmlspecialchars($row['class']) ?></td>
                                     <td>
                                         <button
                                             onclick="location.href='view_student.php?id=<?= htmlspecialchars($row['id']) ?>'"
                                             class="btn btn-sm">👁️ View</button>
                                     </td>
                                 </tr>
                         <?php
                                endwhile;
                            endif;
                            ?>
                         </tbody>
                     </table>
                 </div>
             </section>
             <?php if ($teacher_result->num_rows > 0): ?>

                 <!-- Teachers Section -->
                 <section id="teachers" class="content-section">
                     <h2>👨‍🏫 Teacher Management</h2>
                     <div class="card">
                         <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 1rem;">
                             <button class="btn" onclick="showModal('addTeacherModal')">➕ Add Teacher</button>
                             <input type="text" placeholder="🔍 Search teachers..." style="width: 300px; margin-left: auto;"
                                 onkeyup="searchTable(this, 'teachersTable')">
                         </div>

                         <table class="table" id="teachersTable">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Name</th>
                                     <th>Subject</th>
                                     <th>Class Teacher</th>
                                     <th>Phone</th>
                                     <!-- <th>Email</th> -->
                                     <th>Actions</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    while ($teacher_row = $teacher_result->fetch_assoc()):
                                    ?>
                                     <tr>
                                         <td><?= htmlspecialchars($teacher_row['id']) ?></td>
                                         <td><?= htmlspecialchars($teacher_row['full_name']) ?></td>
                                         <td><?= isset($teacher_row['subject_specialization']) ? htmlspecialchars($teacher_row['subject_specialization']) : '';
                                                ?></td>
                                         <td><?= isset($teacher_row['class_assigned']) ? htmlspecialchars($teacher_row['class_assigned']) : 'Not Assigned' ?>
                                         </td>

                                         <td><?= isset($teacher_row['phone']) ? htmlspecialchars($teacher_row['phone']) : '' ?></td>

                                         <td>
                                             <div class="action-buttons">
                                                 <button
                                                     onclick="location.href='view_teacher.php?id=<?= htmlspecialchars($teacher_row['id']) ?>'"
                                                     class="btn btn-sm">👁️ View</button>
                                                 <!-- <button class="btn btn-sm">✏️ Edit</button> -->
                                                 <!-- <button class="btn btn-sm btn-danger">🚫 Remove</button> -->
                                             </div>
                                         </td>
                                     </tr>
                             <?php
                                    endwhile;
                                endif;
                                ?>
                             </tbody>
                         </table>
                     </div>
                 </section>

                 <!-- Classes Section -->
                 <section id="classes" class="content-section">
                     <h2>🏛️ Class Management</h2>
                     <div class="dashboard-grid">
                         <div class="card">
                             <h3>📚 Classes Overview</h3>
                             <div style="margin-bottom: 1rem;">
                                 <strong>Total Classes:</strong> <?= htmlspecialchars($classes_result->num_rows) ?><br>
                                 <strong>Average Class Size:</strong> <?php echo round($total, 0); ?> students<br>

                             </div>
                         </div>
                         <div class="card">
                             <button style="margin-bottom: 1rem;" class="btn" onclick="showModal('addStudentModal')">➕ Add
                                 Student</button>
                             <button style="margin-bottom: 1rem;" class="btn" onclick="showModal('createClassModal')">➕ Create
                                 New Class</button>

                         </div>
                         <div style="display: none;" class="card">
                             <button class="btn" onclick="addStudent()">➕ Add Student</button>

                             <h3>🎯 Quick Stats</h3>
                             <div style="margin-bottom: 1rem;">
                                 <strong>Grade 7:</strong> 6 classes (234 students)<br>
                                 <strong>Grade 8:</strong> 6 classes (228 students)<br>
                                 <strong>Grade 9:</strong> 5 classes (195 students)<br>
                                 <strong>Grade 10:</strong> 5 classes (187 students)<br>
                                 <strong>Grade 11:</strong> 5 classes (205 students)<br>
                                 <strong>Grade 12:</strong> 5 classes (198 students)
                             </div>
                         </div>
                     </div>
                     <?php if ($classes_result->num_rows > 0): ?>
                         <div class="card">
                             <h3>📋 Class List</h3>
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>Class</th>
                                         <!-- <th>Students</th> -->

                                         <th>Class Teacher</th>
                                         <!-- <th>Room</th> -->
                                         <th>Actions</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        while ($classes_row = $classes_result->fetch_assoc()):
                                        ?>
                                         <tr>
                                             <td><?= htmlspecialchars($classes_row['class_name']) ?></td>
                                             <td><?= htmlspecialchars($classes_row['class_teacher']) ?></td>
                                             <!-- <td>Room 201</td> -->
                                             <td>
                                                 <div class="action-buttons">
                                                     <button
                                                         onclick="location.href='view_class.php?class_name=<?= htmlspecialchars($classes_row['class_name']) ?>'"
                                                         class="btn btn-sm">👁️ View</button>
                                                     <!-- <button class="btn btn-sm">✏️ Edit</button> -->
                                                 </div>
                                             </td>
                                         </tr>
                                 <?php
                                        endwhile;
                                    endif;
                                    ?>
                                 </tbody>
                             </table>
                         </div>
                 </section>

                 <!-- Events Section -->
                 <section id="events" class="content-section">
                     <h2>📅 Events Management</h2>

                     <div class="card">
                         <button class="btn" onclick="showModal('eventModal')" style="margin-bottom: 1rem;">➕ Create
                             Event</button>

                         <div class="dashboard-grid">
                             <?php
                                if ($events_result->num_rows > 0): ?>
                                 <?php while ($events_row = $events_result->fetch_assoc()):
                                    ?>
                                     <div class="card">
                                         <h3><?= htmlspecialchars($events_row['event_name']) ?></h3>
                                         <p><strong>Date:</strong> <?= htmlspecialchars($events_row['event_date']) ?></p>
                                         <p><strong>Time:</strong> <?= htmlspecialchars($events_row['event_time']) ?> </p>
                                         <p><strong>Participants:</strong> <?= htmlspecialchars($events_row['event_participants']) ?></p>
                                         <div class="action-buttons" style="margin-top: 1rem;">
                                             <button class="btn btn-sm btn-danger" onclick="deleteEvent()">🗑️ Delete event</button>
                                             <button id="mark-as-done" class="btn btn-sm btn-primary" onclick="location.href='mark_event.php?event_name=<?= htmlspecialchars($events_row['event_name']) ?>';
                            // change mark as done to marked as done #
                            document.getElementById('mark-as-done').addEventListener('click', () => this.id.textContent = 'Done ✅')
                            "> Mark as Done ✅</button>
                                         </div>
                                     </div>
                             <?php
                                    endwhile;
                                endif; ?>
                         </div>
                     </div>

                 </section>

                 <!-- Advertisements Section -->
                 <section id="advertisements" class="content-section">
                     <h2>📺 Advertisement Management</h2>
                     <div class="card">
                         <button class="btn" onclick="showModal('adModal')" style="margin-bottom: 1rem;">➕ Create
                             Advertisement</button>

                         <div class="announcement-item">
                             <div class="announcement-date">Active - Expires: June 30, 2025</div>
                             <div class="announcement-title">🎓 Enrollment Open for 2025-2026 Academic Year</div>
                             <p>Join Rukara Model School! We're now accepting applications for the new academic year. Limited
                                 seats available. Apply today!</p>
                             <div class="action-buttons" style="margin-top: 1rem;">
                                 <button class="btn btn-sm">✏️ Edit</button>
                                 <button class="btn btn-sm btn-success">📈 Analytics</button>
                                 <button class="btn btn-sm btn-danger">⏹️ Stop</button>
                             </div>
                         </div>

                         <div class="announcement-item">
                             <div class="announcement-date">Active - Expires: July 15, 2025</div>
                             <div class="announcement-title">👨‍🏫 Teaching Positions Available</div>
                             <p>We're hiring qualified teachers for Mathematics, Science, and English. Excellent benefits and
                                 competitive salary. Join our team!</p>
                             <div class="action-buttons" style="margin-top: 1rem;">
                                 <button class="btn btn-sm">✏️ Edit</button>
                                 <button class="btn btn-sm btn-success">📈 Analytics</button>
                                 <button class="btn btn-sm btn-danger">⏹️ Stop</button>
                             </div>
                         </div>
                     </div>
                 </section>

                 <!-- Reports Section -->
                 <section id="reports" class="content-section">
                     <h2>📈 Reports & Analytics</h2>
                     <div class="dashboard-grid">
                         <div class="card">
                             <h3>📊 Academic Performance</h3>
                             <p>Generate comprehensive academic reports</p>
                             <button class="btn" style="margin-top: 1rem;">📄 Generate Report</button>
                         </div>

                         <div class="card">
                             <h3>👥 Attendance Reports</h3>
                             <p>Track student and teacher attendance</p>
                             <button class="btn" style="margin-top: 1rem;">📄 Generate Report</button>
                         </div>

                         <div class="card">
                             <h3>💰 Financial Reports</h3>
                             <p>School fees and financial summaries</p>
                             <button class="btn" style="margin-top: 1rem;">📄 Generate Report</button>
                         </div>

                         <div class="card">
                             <h3>📈 Growth Analytics</h3>
                             <p>Student enrollment and school growth</p>
                             <button class="btn" style="margin-top: 1rem;">📄 Generate Report</button>
                         </div>
                     </div>
                 </section>

                 <!-- Settings Section -->
                 <section id="settings" class="content-section">
                     <h2>⚙️ System Settings</h2>
                     <div class="dashboard-grid">
                         <div class="card">
                             <h3>🏫 School Information</h3>
                             <div class="form-group">
                                 <label>School Name</label>
                                 <input type="text" value="Rukara Model School">
                             </div>
                             <div class="form-group">
                                 <label>Address</label>
                                 <textarea>Kayonza, Rwanda</textarea>
                             </div>
                             <div class="form-group">
                                 <label>Contact Phone</label>
                                 <input type="tel" value="+250788244491 / +25079245452">
                             </div>
                             <button class="btn">💾 Save Changes</button>
                         </div>

                         <div class="card">
                             <h3>🎓 Academic Settings</h3>
                             <div class="form-group">
                                 <label>Current Academic Year</label>
                                 <select>
                                     <option>2024-2025</option>
                                     <option selected>2025-2026</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label>Current Term</label>
                                 <select>
                                     <option>Term 1</option>
                                     <option>Term 2</option>
                                     <option selected>Term 3</option>
                                 </select>
                             </div>
                             <button style="margin-bottom: 2em;" class="btn">💾 Save Settings</button>
                             <button
                                 style="background-color:linear-gradient(to right,rgb(0, 255, 47),rgb(225, 255, 0)); color: #fff;"
                                 class="btn btn-primary" onclick="showModal('changePasswordModal')">🗝️Change your
                                 password</button>
                         </div>
                     </div>
                 </section>
     </main>
     <!-- Modals -->
     <div id="createClassModal" class="modal">
         <div class="modal-content">
             <form id="classForm" action="create_class.php" method="POST">
                 <span class="close" onclick="hideModal('createClassModal')">&times;</span>
                 <h2>🏫 Create Class</h2>
                 <div class="form-group">
                     <label>Select Class</label>
                     <select name="class_name" id="classSelect">
                         <option value="" hidden>Select Class</option>
                         <option value="S1A">S1A</option>
                         <option value="S1B">S1B</option>
                         <option value="S2A">S2A</option>
                         <option value="S2B">S2B</option>
                         <option value="S3A">S3A</option>
                         <option value="S3B">S3B</option>
                         <option value="S4MCE">S4MCE</option>
                         <option value="S4MPC">S4MPC</option>
                         <option value="S4MEG">S4MEG</option>
                         <option value="S5MCE">S5MCE</option>
                         <option value="S5MPC">S5MPC</option>
                         <option value="S5MEG">S5MEG</option>
                         <option value="S6MCE">S6MCE</option>
                         <option value="S6MPC">S6MPC</option>
                         <option value="S6MEG">S6MEG</option>
                     </select>
                 </div>
                 <div class="form-group">
                     <label>Number of Students</label>
                     <input type="number" name="total_students" id="studentsInput"
                         placeholder="Enter number of students" min="1">
                 </div>
                 <div class="form-group">
                     <label>Class Teacher</label>
                     <select id="teacherSelect" name="class_teacher">
                         <option hidden>Select the class teacher</option>
                         <option value="Yanick">Yanick</option>
                         <option value="Eric">Eric</option>
                         <option value="Alice">Alice</option>
                         <option value="John">John</option>
                     </select>
                 </div>
                 <button class="btn" onclick="createClass()">🏫 Create Class</button>
         </div>
         </form>
     </div>
     </div>
     <div id="addStudentModal" class="modal">
         <div class="modal-content">
             <form action="register_student.php" method="POST">
                 <!--onsubmit="return validateForm()"-->
                 <span class="close" onclick="
                hideModal('addStudentModal')
                ">&times;</span>
                 <h2>👥 Add New Student</h2>
                 <div class="form-group">
                     <label>Full Name</label>
                     <input type="text" name="full_name" placeholder="Enter student full name">
                 </div>
                 <div class="form-group">
                     <label>Date of Birth</label>
                     <input type="date" name="date_of_birth">
                 </div>
                 <div class="form-group">
                     <label>Class</label>
                     <?php if ($classes2_result->num_rows > 0): ?>
                         <select name="class">
                             <option value="" hidden>Select Class</option>
                             <?php
                                while ($classes2_row = $classes2_result->fetch_assoc()):
                                ?>
                                 <option value="<?= htmlspecialchars($classes2_row['class_name']) ?>">
                                     <?= htmlspecialchars($classes2_row['class_name']) ?></option>
                             <?php endwhile; ?>

                         </select>
                     <?php else: ?>

                     <?php endif; ?>
                 </div>
                 <div class="form-group">
                     <label>Parent/Guardian Name</label>
                     <input type="text" name="parent_name" placeholder="Enter parent/guardian name">

                 </div>
                 <div class="form-group">
                     <label>Parent Contact</label>
                     <input type="tel" name="parent_contact" placeholder="+250 788 000 000">

                 </div>
                 <!-- <div class="form-group">
                <label>Address</label>
                <textarea rows="3" placeholder="Enter home address"></textarea>
            </div> -->
                 <button class="btn" onclick="addStudent()">➕ Add Student</button>
             </form>

         </div>
     </div>

     <div id="addTeacherModal" class="modal">
         <div class="modal-content">
             <form action="register_teacher.php" method="POST">
                 <span class="close" onclick="hideModal('addTeacherModal')">&times;</span>
                 <h2>👨‍🏫 Add New Teacher</h2>
                 <div class="form-group">
                     <label>Full Name</label>
                     <input type="text" name="full_name" placeholder="Enter teacher full name">
                 </div>
                 <div class="form-group">
                     <label>Subject Specialization</label>
                     <select name="subject">
                         <option value="Mathematics">Mathematics</option>
                         <option value="Physics">Physics</option>
                         <option value="Chemistry">Chemistry</option>
                         <option value="Biology">Biology</option>
                         <option value="English">English</option>
                         <option value="Kinyarwanda">Kinyarwanda</option>
                         <option value="French">French</option>
                         <option value="History">History</option>
                         <option value="Geography">Geography</option>
                         <option value="Computer Science">Computer Science</option>
                         <option value="Physical Education">Physical Education</option>
                     </select>
                 </div>

                 <div class="form-group">
                     <label>Email</label>
                     <input type="email" name="email" placeholder="teacher@rukara.edu.rw">
                 </div>
                 <div class="form-group">
                     <label>Phone Number</label>
                     <input type="tel" name="phone" placeholder="+250 788 000 000">
                 </div>
                 <div class="form-group">
                     <label>Qualification</label>
                     <select name="qualification">
                         <option value="Bachelor's Degree">Bachelor's Degree</option>
                         <option value="Master's Degree">Master's Degree</option>
                         <option value="PhD">PhD</option>
                         <option value="Diploma">Diploma</option>
                     </select>
                 </div>
                 <div class="form-group">
                     <label>Years of Experience</label>
                     <input type="number" name="experience" placeholder="0" min="0">
                 </div>
                 <div class="form-group">
                     <label>Class Assigned</label>
                     <select name="class_assigned" id="">
                         <option value="S1A">S1A</option>
                         <option value="S1B">S1B</option>
                         <option value="S2A">S2A</option>
                         <option value="S2B">S2B</option>
                         <option value="S3A">S3A</option>
                         <option value="S3B">S3B</option>
                         <option value="S4MCE">S4MCE</option>
                         <option value="S4MPC">S4MPC</option>
                         <option value="S4MEG">S4MEG</option>
                         <option value="S5MCE">S5MCE</option>
                         <option value="S5MPC">S5MPC</option>
                         <option value="S5MEG">S5MEG</option>
                         <option value="S6MCE">S6MCE</option>
                         <option value="S6MPC">S6MPC</option>
                         <option value="S6MEG">S6MEG</option>
                     </select>
                 </div>
                 <button class="btn" onclick="addTeacher()">👨‍🏫 Add Teacher</button>
             </form>
         </div>
     </div>
     <div id="announcementModal" class="modal">
         <div class="modal-content">
             <span class="close" onclick="hideModal('announcementModal')">&times;</span>
             <h2>📢 Create Announcement</h2>
             <div class="form-group">
                 <label>Title</label>
                 <input type="text" placeholder="Enter announcement title">
             </div>
             <div class="form-group">
                 <label>Content</label>
                 <textarea rows="4" placeholder="Enter announcement content"></textarea>
             </div>
             <div class="form-group">
                 <label>Priority</label>
                 <select>
                     <option>Normal</option>
                     <option>Important</option>
                     <option>Urgent</option>
                 </select>
             </div>
             <div class="form-group">
                 <label>Target Audience</label>
                 <select>
                     <option>All</option>
                     <option>Students</option>
                     <option>Teachers</option>
                     <option>Parents</option>
                 </select>
             </div>
             <button class="btn" onclick="createAnnouncement()">📢 Publish Announcement</button>
         </div>
     </div>

     <div id="changePasswordModal" class="modal">
         <div class="modal-content">
             <form action="/RMS-Project/login/change_password.php" method="POST">
                 <span class="close" onclick="hideModal('changePasswordModal')">&times;</span>
                 <h2>🗝️Change Password</h2>
                 <div class="form-group">
                     <label>Email</label>
                     <input readonly name="email" type="text" value="<?php echo $email; ?>">
                 </div>
                 <div class="form-group">
                     <input name="currentpassword" type="text" placeholder="Current Password">
                 </div>
                 <div class="form-group">
                     <input name="newpassword" type="text" placeholder="New Password">
                 </div>
                 <button class="btn" type="submit">Change password</button>
             </form>
         </div>
     </div>

     <div id="adModal" class="modal">
         <div class="modal-content">
             <span class="close" onclick="hideModal('adModal')">&times;</span>
             <h2>📺 Create Advertisement</h2>
             <div class="form-group">
                 <label>Advertisement Title</label>
                 <input type="text" placeholder="Enter advertisement title">
             </div>
             <div class="form-group">
                 <label>Content</label>
                 <textarea rows="4" placeholder="Enter advertisement content"></textarea>
             </div>
             <div class="form-group">
                 <label>Campaign Type</label>
                 <select>
                     <option>Enrollment</option>
                     <option>Job Vacancy</option>
                     <option>Event Promotion</option>
                     <option>Achievement</option>
                     <option>General</option>
                 </select>
             </div>
             <div class="form-group">
                 <label>Duration (Days)</label>
                 <input type="number" placeholder="30" min="1">
             </div>
             <div class="form-group">
                 <label>Target Audience</label>
                 <select>
                     <option>General Public</option>
                     <option>Parents</option>
                     <option>Job Seekers</option>
                     <option>Students</option>
                 </select>
             </div>
             <button class="btn" onclick="createAd()">📺 Launch Advertisement</button>
         </div>
     </div>
     <script>
         document.getElementById("classForm").addEventListener("submit", function(e) {
             e.preventDefault(); // Stop normal form submission
             const classSelect = document.getElementById("classSelect");
             const teacherSelect = document.getElementById("teacherSelect");
             const studentsInput = document.getElementById("studentsInput");
             const classId = classSelect.value;
             const totalStudents = studentsInput.value;
             const teacherId = teacherSelect.value;
             if (!classId || !totalStudents || !teacherId) {
                 alert("Please fill all fields.");
                 return;
             }
             // Send data to PHP
             const formData = new FormData();
             formData.append("class_name", classId);
             formData.append("total_students", totalStudents);
             formData.append("class_teacher", teacherId);
             fetch("create_class.php", {
                     method: "POST",
                     body: formData
                 })
                 .then(res => res.text())
                 .then(data => {
                     console.log("Server response:", data); // 🔍 Add this line to debug
                     if (data.trim() === "success") {
                         classSelect.remove(classSelect.selectedIndex);
                         alert("Class added successfully.");
                     } else {
                         alert("Error: " + data);
                     }
                 })
         });
     </script>

     <script>
         //logout
         function logout() {
             window.location.href = "/RMS-Project/includes/logout";
         }
         // Initialize current date
         document.getElementById('currentDate').textContent = new Date().toLocaleDateString('en-RW', {
             weekday: 'long',
             year: 'numeric',
             month: 'long',
             day: 'numeric'
         });
         // Navigation functionality
         function showSection(sectionId) {
             // Hide all sections
             const sections = document.querySelectorAll('.content-section');
             sections.forEach(section => {
                 section.classList.remove('active');
             });
             // Remove active class from nav items
             const navItems = document.querySelectorAll('.nav-item');
             navItems.forEach(item => {
                 item.classList.remove('active');
             });
             // Show selected section
             document.getElementById(sectionId).classList.add('active');
             // Add active class to clicked nav item
             event.target.closest('.nav-item').classList.add('active');
         }
         // Modal functionality
         function showModal(modalId) {
             document.getElementById(modalId).style.display = 'block';
         }

         function hideModal(modalId) {
             document.getElementById(modalId).style.display = 'none';
         }
         // Close modals when clicking outside
         window.onclick = function(event) {
             if (event.target.classList.contains('modal')) {
                 event.target.style.display = 'none';
             }
         }
         // Search functionality
         function searchTable(input, tableId) {
             const filter = input.value.toLowerCase();
             const table = document.getElementById(tableId);
             const rows = table.getElementsByTagName('tr');
             for (let i = 1; i < rows.length; i++) {
                 const cells = rows[i].getElementsByTagName('td');
                 let match = false;
                 for (let j = 0; j < cells.length; j++) {
                     if (cells[j].textContent.toLowerCase().includes(filter)) {
                         match = true;
                         break;
                     }
                 }
                 rows[i].style.display = match ? '' : 'none';
             }
         }
         // Form submission functions
         function createAnnouncement() {
             // Simulate announcement creation
             alert('📢 Announcement published successfully!');
             hideModal('announcementModal');
             // In a real application, this would send data to the server
             // and update the announcements list
         }

         function createClass() {
             hideModal('createClassModal');
             // In a real application, this would send data to the server
             // and update the announcements list
         }

         function addStudent() {
             // Simulate student addition
             // alert('👥 Student added successfully!');
             location.href = "register_student.php";
             // In a real application, this would send data to the server
             // and update the students table
         }

         function addTeacher() {
             // Simulate teacher addition
             alert('👨‍🏫 Teacher added successfully!');
             hideModal('addTeacherModal');
             // In a real application, this would send data to the server
             // and update the teachers table
         }

         function createEvent() {
             // Simulate event creation
             alert('📅 Event created successfully!');
             hideModal('eventModal');
             // In a real application, this would send data to the server
             // and update the events list
         }

         function createAd() {
             // Simulate advertisement creation
             alert('📺 Advertisement launched successfully!');
             hideModal('adModal');
             // In a real application, this would send data to the server
             // and update the advertisements list
         }
         // Simulate real-time updates
         function updateStats() {
             // This would typically fetch real data from the server
             const stats = document.querySelectorAll('.stat-number');
             stats.forEach(stat => {
                 const currentValue = parseInt(stat.textContent.replace(',', ''));
                 // Simulate small random changes
                 const change = Math.floor(Math.random() * 3) - 1;
                 const newValue = Math.max(0, currentValue + change);
                 stat.textContent = newValue.toLocaleString();
             });
         }
         // Update stats every 30 seconds
         setInterval(updateStats, 30000);
         // Welcome message
         // setTimeout(() => {
         //     alert('🏫 Welcome to Rukara Model School Administration Dashboard!\n\nYou can:\n• Manage students and teachers\n• Create announcements and events\n• Monitor school statistics\n• Generate reports\n• Control advertisements\n\nEverything you need to run the school efficiently!');
         // }, 1000);
         // Add this to your existing JavaScript
         document.addEventListener('DOMContentLoaded', function() {
             const sidebarToggle = document.getElementById('sidebarToggle');
             const sidebar = document.querySelector('.sidebar');
             const mainContent = document.querySelector('.main-content');
             sidebarToggle.addEventListener('click', function() {
                 sidebar.classList.toggle('active');
                 mainContent.classList.toggle('expanded');
             });
             // Close sidebar when clicking outside on mobile
             document.addEventListener('click', function(event) {
                 const isClickInsideSidebar = sidebar.contains(event.target);
                 const isClickInsideToggle = sidebarToggle.contains(event.target);
                 if (!isClickInsideSidebar && !isClickInsideToggle && window.innerWidth <= 768) {
                     sidebar.classList.remove('active');
                     mainContent.classList.add('expanded');
                 }
             });
             // Handle window resize
             window.addEventListener('resize', function() {
                 if (window.innerWidth > 768) {
                     sidebar.classList.remove('active');
                     mainContent.classList.remove('expanded');
                 }
             });
         });
     </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

 </body>

 </html>