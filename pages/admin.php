<?php
session_start();

// Optional: Block access if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Access the name and role
$userName = $_SESSION['user_name'];
$userRole = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rukara Model School - Administration</title>
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
    <?php include("../includes/progress-bar.php");?>

    <header class="header">
        <div class="header-content">
            <!-- <div class="logo">
                <h1><a href="/RMS-Project/">Rukara Model School</a></h1>
            </div> -->
            <div class="admin-info">
                <span><?php echo htmlspecialchars($userName); ?> (<?php echo $userRole; ?>)</span>
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
                <div class="card stat-card">
                    <div class="stat-number">832</div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="card stat-card">
                    <div class="stat-number">36</div>
                    <div class="stat-label">Teachers</div>
                </div>
                <div class="card stat-card">
                    <div class="stat-number">22</div>
                    <div class="stat-label">Classes</div>
                </div>
                <div class="card stat-card">
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
                        <p>Due to weather conditions, Sports Day has been rescheduled to June 15, 2025. All participants
                            will be notified of the new arrangements.</p>
                        <div class="action-buttons" style="margin-top: 1rem;">
                            <button class="btn btn-sm">✏️ Edit</button>
                            <button class="btn btn-sm btn-danger">🗑️ Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                            <th>Parent Contact</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>STU001</td>
                            <td>Jean Baptiste Uwimana</td>
                            <td>Grade 10A</td>
                            <td>+250 788 123 456</td>
                            <td><span style="color: #48bb78; font-weight: 600;">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm">👁️ View</button>
                                    <button class="btn btn-sm">✏️ Edit</button>
                                    <button class="btn btn-sm btn-danger">❌ Suspend</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>STU002</td>
                            <td>Marie Claire Gasana</td>
                            <td>Grade 11B</td>
                            <td>+250 788 234 567</td>
                            <td><span style="color: #48bb78; font-weight: 600;">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm">👁️ View</button>
                                    <button class="btn btn-sm">✏️ Edit</button>
                                    <button class="btn btn-sm btn-danger">❌ Suspend</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>STU003</td>
                            <td>Patrick Niyomugabo</td>
                            <td>Grade 9C</td>
                            <td>+250 788 345 678</td>
                            <td><span style="color: #ed8936; font-weight: 600;">Warning</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm">👁️ View</button>
                                    <button class="btn btn-sm">✏️ Edit</button>
                                    <button class="btn btn-sm btn-danger">❌ Suspend</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

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
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TEA001</td>
                            <td>Dr. Sarah Mukamana</td>
                            <td>Mathematics</td>
                            <td>+250 788 111 222</td>
                            <td>sarah.mukamana@rukara.edu.rw</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm">👁️ View</button>
                                    <button class="btn btn-sm">✏️ Edit</button>
                                    <button class="btn btn-sm btn-danger">🚫 Remove</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>TEA002</td>
                            <td>Mr. Emmanuel Bizimana</td>
                            <td>Physics</td>
                            <td>+250 788 222 333</td>
                            <td>emmanuel.bizimana@rukara.edu.rw</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm">👁️ View</button>
                                    <button class="btn btn-sm">✏️ Edit</button>
                                    <button class="btn btn-sm btn-danger">🚫 Remove</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Classes Section -->
        <section id="classes" class="content-section">
            <h2>🏛️ Class Management</h2>
            <div class="dashboard-grid">
                <div class="card">
                    <h3>📚 Class Overview</h3>
                    <div style="margin-bottom: 1rem;">
                        <strong>Total Classes:</strong> 32<br>
                        <strong>Average Class Size:</strong> 39 students<br>
                        <strong>Teacher-Student Ratio:</strong> 1:18
                    </div>
                    <button class="btn">➕ Create New Class</button>
                </div>

                <div class="card">
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

            <div class="card">
                <h3>📋 Class List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Class Teacher</th>
                            <th>Students</th>
                            <th>Room</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Grade 10A</td>
                            <td>Dr. Sarah Mukamana</td>
                            <td>38</td>
                            <td>Room 201</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm">👁️ View</button>
                                    <button class="btn btn-sm">✏️ Edit</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Grade 11B</td>
                            <td>Mr. Emmanuel Bizimana</td>
                            <td>41</td>
                            <td>Room 301</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm">👁️ View</button>
                                    <button class="btn btn-sm">✏️ Edit</button>
                                </div>
                            </td>
                        </tr>
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
                    <div class="card">
                        <h3>🏆 Sports Day</h3>
                        <p><strong>Date:</strong> June 15, 2025</p>
                        <p><strong>Time:</strong> 8:00 AM - 5:00 PM</p>
                        <p><strong>Participants:</strong> All students</p>
                        <div class="action-buttons" style="margin-top: 1rem;">
                            <button class="btn btn-sm">✏️ Edit</button>
                            <button class="btn btn-sm btn-success">✅ Publish</button>
                            <button class="btn btn-sm btn-danger">🗑️ Cancel</button>
                        </div>
                    </div>

                    <div class="card">
                        <h3>🎭 Cultural Festival</h3>
                        <p><strong>Date:</strong> July 20, 2025</p>
                        <p><strong>Time:</strong> 2:00 PM - 8:00 PM</p>
                        <p><strong>Participants:</strong> Students & Parents</p>
                        <div class="action-buttons" style="margin-top: 1rem;">
                            <button class="btn btn-sm">✏️ Edit</button>
                            <button class="btn btn-sm btn-success">✅ Publish</button>
                            <button class="btn btn-sm btn-danger">🗑️ Cancel</button>
                        </div>
                    </div>
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
                    <button class="btn">💾 Save Settings</button>
                </div>
            </div>
        </section>
    </main>

    <!-- Modals -->
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

    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="hideModal('addStudentModal')">&times;</span>
            <h2>👥 Add New Student</h2>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" placeholder="Enter student full name">
            </div>
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date">
            </div>
            <div class="form-group">
                <label>Class</label>
                <select>
                    <option>Grade 7A</option>
                    <option>Grade 7B</option>
                    <option>Grade 8A</option>
                    <option>Grade 8B</option>
                    <option>Grade 9A</option>
                    <option>Grade 9B</option>
                    <option>Grade 10A</option>
                    <option>Grade 10B</option>
                    <option>Grade 11A</option>
                    <option>Grade 11B</option>
                    <option>Grade 12A</option>
                    <option>Grade 12B</option>
                </select>
            </div>
            <div class="form-group">
                <label>Parent/Guardian Name</label>
                <input type="text" placeholder="Enter parent/guardian name">
            </div>
            <div class="form-group">
                <label>Parent Contact</label>
                <input type="tel" placeholder="+250 788 000 000">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea rows="3" placeholder="Enter home address"></textarea>
            </div>
            <button class="btn" onclick="addStudent()">➕ Add Student</button>
        </div>
    </div>

    <div id="addTeacherModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="hideModal('addTeacherModal')">&times;</span>
            <h2>👨‍🏫 Add New Teacher</h2>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" placeholder="Enter teacher full name">
            </div>
            <div class="form-group">
                <label>Subject Specialization</label>
                <select>
                    <option>Mathematics</option>
                    <option>Physics</option>
                    <option>Chemistry</option>
                    <option>Biology</option>
                    <option>English</option>
                    <option>Kinyarwanda</option>
                    <option>French</option>
                    <option>History</option>
                    <option>Geography</option>
                    <option>Computer Science</option>
                    <option>Physical Education</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="teacher@rukara.edu.rw">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" placeholder="+250 788 000 000">
            </div>
            <div class="form-group">
                <label>Qualification</label>
                <select>
                    <option>Bachelor's Degree</option>
                    <option>Master's Degree</option>
                    <option>PhD</option>
                    <option>Diploma</option>
                </select>
            </div>
            <div class="form-group">
                <label>Years of Experience</label>
                <input type="number" placeholder="0" min="0">
            </div>
            <button class="btn" onclick="addTeacher()">👨‍🏫 Add Teacher</button>
        </div>
    </div>

    <div id="eventModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="hideModal('eventModal')">&times;</span>
            <h2>📅 Create Event</h2>
            <div class="form-group">
                <label>Event Name</label>
                <input type="text" placeholder="Enter event name">
            </div>
            <div class="form-group">
                <label>Event Type</label>
                <select>
                    <option>Academic</option>
                    <option>Sports</option>
                    <option>Cultural</option>
                    <option>Social</option>
                    <option>Competition</option>
                    <option>Meeting</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date">
            </div>
            <div class="form-group">
                <label>Time</label>
                <input type="time">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" placeholder="Event location">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea rows="4" placeholder="Event description"></textarea>
            </div>
            <div class="form-group">
                <label>Participants</label>
                <select>
                    <option>All Students</option>
                    <option>Specific Grade</option>
                    <option>Teachers Only</option>
                    <option>Parents & Students</option>
                    <option>Public Event</option>
                </select>
            </div>
            <button class="btn" onclick="createEvent()">📅 Create Event</button>
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

        function addStudent() {
            // Simulate student addition
            alert('👥 Student added successfully!');
            hideModal('addStudentModal');
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
</body>

</html>