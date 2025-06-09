 <script>
        // Sample data
        const studentsData = {
            'math-10a': ['John Mukamana', 'Sarah Uwimana', 'David Nkurunziza', 'Grace Nyirahabimana', 'Peter Gasana', 'Mary Ingabire'],
            'math-10b': ['Alice Mutesi', 'James Habimana', 'Ruth Nyamwasa', 'Paul Ntirugiririmana', 'Jane Uwase', 'Eric Niyonshima'],
            'physics-11a': ['Robert Mugabo', 'Linda Umuhoza', 'Frank Nzeyimana', 'Rose Mukandayisenga', 'Simon Rugema'],
            'physics-11b': ['Emma Mukantagara', 'Thomas Nshimiyimana', 'Helen Nyiramana', 'Charles Uwizeye', 'Betty Mukamugema'],
            'chemistry-12a': ['Michael Rugira', 'Anna Nyirabagenzi', 'Kevin Nshimiye', 'Diane Mukansanga', 'Brian Hitimana'],
            'chemistry-12b': ['Jennifer Mukandori', 'Steven Niyibizi', 'Carol Uwimana', 'Mark Nsengiyumva', 'Lisa Nyiragira']
        };

        const assignmentsData = {
            'math-10a': ['Algebra Homework #5', 'Quadratic Equations Quiz', 'Chapter 3 Test'],
            'math-10b': ['Linear Functions Homework', 'Graphing Quiz', 'Midterm Exam'],
            'physics-11a': ['Motion Lab Report', 'Forces Quiz', 'Energy Conservation Test'],
            'physics-11b': ['Waves Homework', 'Optics Quiz', 'Final Project'],
            'chemistry-12a': ['Organic Compounds Lab', 'Reactions Quiz', 'Stoichiometry Test'],
            'chemistry-12b': ['Acid-Base Homework', 'Equilibrium Quiz', 'Final Exam']
        };

        let selectedAssignmentType = '';
        let attendanceData = {};
        let messageRecipients = [];

        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.body.style.overflow = 'auto';
            
            // Reset forms when closing
            if (modalId === 'attendanceModal') {
                document.getElementById('attendanceClass').value = '';
                document.getElementById('studentsGrid').style.display = 'none';
                attendanceData = {};
            } else if (modalId === 'assignmentModal') {
                resetAssignmentForm();
            } else if (modalId === 'messageModal') {
                resetMessageForm();
            } else if (modalId === 'gradingModal') {
                resetGradingForm();
            }
        }

        // Quick Actions - Updated to use modals
        function takeAttendance() {
            openModal('attendanceModal');
        }

        function gradeAssignments() {
            openModal('gradingModal');
        }

        function createAssignment() {
            openModal('assignmentModal');
        }

        function sendMessage() {
            openModal('messageModal');
        }

        // Attendance functions
        function loadStudents() {
            const classSelect = document.getElementById('attendanceClass');
            const studentsGrid = document.getElementById('studentsGrid');
            const selectedClass = classSelect.value;

            if (selectedClass && studentsData[selectedClass]) {
                studentsGrid.innerHTML = '';
                studentsData[selectedClass].forEach(student => {
                    const studentDiv = document.createElement('div');
                    studentDiv.className = 'student-item';
                    studentDiv.innerHTML = `
                        <span class="student-name">${student}</span>
                        <div class="attendance-options">
                            <button class="attendance-btn present" onclick="markAttendance('${student}', 'present', this)">P</button>
                            <button class="attendance-btn absent" onclick="markAttendance('${student}', 'absent', this)">A</button>
                            <button class="attendance-btn late" onclick="markAttendance('${student}', 'late', this)">L</button>
                        </div>
                    `;
                    studentsGrid.appendChild(studentDiv);
                });
                studentsGrid.style.display = 'grid';
                
                // Initialize attendance data
                attendanceData = {};
                studentsData[selectedClass].forEach(student => {
                    attendanceData[student] = 'present'; // Default to present
                });
            } else {
                studentsGrid.style.display = 'none';
            }
        }

        function markAttendance(student, status, button) {
            // Remove active class from all buttons in this row
            const row = button.parentElement;
            row.querySelectorAll('.attendance-btn').forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            button.classList.add('active');
            
            // Store attendance data
            attendanceData[student] = status;
        }

        function saveAttendance() {
            const classSelect = document.getElementById('attendanceClass');
            const selectedClass = classSelect.options[classSelect.selectedIndex].text;
            
            if (Object.keys(attendanceData).length === 0) {
                alert('Please select a class and mark attendance first.');
                return;
            }

            // Count attendance statistics
            let presentCount = 0, absentCount = 0, lateCount = 0;
            Object.values(attendanceData).forEach(status => {
                if (status === 'present') presentCount++;
                else if (status === 'absent') absentCount++;
                else if (status === 'late') lateCount++;
            });

            // Show success message
            const modalContent = document.querySelector('#attendanceModal .modal-content');
            modalContent.innerHTML = `
                <div class="modal-header">
                    <h2>✅ Attendance Saved!</h2>
                    <button class="close-btn" onclick="closeModal('attendanceModal')">&times;</button>
                </div>
                <div class="success-message">
                    Attendance for ${selectedClass} has been successfully recorded.
                </div>
                <div class="stats-grid" style="margin: 20px 0;">
                    <div class="stat-item">
                        <div class="stat-number" style="color: #2ecc71;">${presentCount}</div>
                        <div class="stat-label">Present</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" style="color: #e74c3c;">${absentCount}</div>
                        <div class="stat-label">Absent</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" style="color: #f39c12;">${lateCount}</div>
                        <div class="stat-label">Late</div>
                    </div>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-primary" onclick="closeModal('attendanceModal')">Done</button>
                </div>
            `;

            // Update dashboard stats
            updateAttendanceStats();
        }

        // Assignment functions
        function selectType(element, type) {
            document.querySelectorAll('.type-option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');
            selectedAssignmentType = type;
        }

        function createAssignmentSubmit() {
            const title = document.getElementById('assignmentTitle').value;
            const classSelect = document.getElementById('assignmentClass');
            const selectedClass = classSelect.options[classSelect.selectedIndex].text;
            const dueDate = document.getElementById('assignmentDue').value;
            const points = document.getElementById('assignmentPoints').value;
            const description = document.getElementById('assignmentDescription').value;

            if (!title || !selectedClass || !dueDate || !selectedAssignmentType) {
                alert('Please fill in all required fields.');
                return;
            }

            // Show success message
            const modalContent = document.querySelector('#assignmentModal .modal-content');
            modalContent.innerHTML = `
                <div class="modal-header">
                    <h2>✅ Assignment Created!</h2>
                    <button class="close-btn" onclick="closeModal('assignmentModal')">&times;</button>
                </div>
                <div class="success-message">
                    Assignment "${title}" has been successfully created for ${selectedClass}.
                </div>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; margin: 15px 0;">
                    <strong>Assignment Details:</strong><br>
                    <strong>Type:</strong> ${selectedAssignmentType.charAt(0).toUpperCase() + selectedAssignmentType.slice(1)}<br>
                    <strong>Due:</strong> ${new Date(dueDate).toLocaleString()}<br>
                    <strong>Points:</strong> ${points || 'Not specified'}<br>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-primary" onclick="closeModal('assignmentModal')">Done</button>
                </div>
            `;
        }

        function resetAssignmentForm() {
            document.getElementById('assignmentTitle').value = '';
            document.getElementById('assignmentClass').value = '';
            document.getElementById('assignmentDue').value = '';
            document.getElementById('assignmentPoints').value = '';
            document.getElementById('assignmentDescription').value = '';
            document.querySelectorAll('.type-option').forEach(opt => opt.classList.remove('selected'));
            selectedAssignmentType = '';
        }

        // Grading functions
        function loadAssignments() {
            const classSelect = document.getElementById('gradingClass');
            const assignmentSelect = document.getElementById('gradingAssignment');
            const selectedClass = classSelect.value;

            assignmentSelect.innerHTML = '<option value="">Choose an assignment...</option>';
            
            if (selectedClass && assignmentsData[selectedClass]) {
                assignmentsData[selectedClass].forEach(assignment => {
                    const option = document.createElement('option');
                    option.value = assignment;
                    option.textContent = assignment;
                    assignmentSelect.appendChild(option);
                });
            }
        }

        function loadSubmissions() {
            const classSelect = document.getElementById('gradingClass');
            const assignmentSelect = document.getElementById('gradingAssignment');
            const submissionsGrid = document.getElementById('submissionsGrid');
            const submissionsList = document.getElementById('submissionsList');

            if (classSelect.value && assignmentSelect.value) {
                const students = studentsData[classSelect.value];
                submissionsList.innerHTML = '';
                
                students.forEach(student => {
                    const submissionDiv = document.createElement('div');
                    submissionDiv.className = 'student-item';
                    submissionDiv.innerHTML = `
                        <span class="student-name">${student}</span>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <input type="number" placeholder="Grade" min="0" max="100" style="width: 80px; padding: 8px; border: 1px solid #ddd; border-radius: 5px;" id="grade-${student}">
                            <span style="color: #7f8c8d; font-size: 0.9rem;">/ 100</span>
                        </div>
                    `;
                    submissionsList.appendChild(submissionDiv);
                });
                
                submissionsGrid.style.display = 'block';
            } else {
                submissionsGrid.style.display = 'none';
            }
        }

        function saveGrades() {
            const classSelect = document.getElementById('gradingClass');
            const assignmentSelect = document.getElementById('gradingAssignment');
            const selectedClass = classSelect.options[classSelect.selectedIndex].text;
            const selectedAssignment = assignmentSelect.value;
            
            if (!selectedClass || !selectedAssignment) {
                alert('Please select a class and assignment first.');
                return;
            }

            // Collect grades
            const students = studentsData[classSelect.value];
            let gradedCount = 0;
            let totalPoints = 0;

            students.forEach(student => {
                const gradeInput = document.getElementById(`grade-${student}`);
                if (gradeInput && gradeInput.value) {
                    gradedCount++;
                    totalPoints += parseInt(gradeInput.value);
                }
            });

            if (gradedCount === 0) {
                alert('Please enter at least one grade.');
                return;
            }

            const averageGrade = Math.round(totalPoints / gradedCount);

            // Show success message
            const modalContent = document.querySelector('#gradingModal .modal-content');
            modalContent.innerHTML = `
                <div class="modal-header">
                    <h2>✅ Grades Saved!</h2>
                    <button class="close-btn" onclick="closeModal('gradingModal')">&times;</button>
                </div>
                <div class="success-message">
                    Grades for "${selectedAssignment}" in ${selectedClass} have been successfully saved.
                </div>
                <div class="stats-grid" style="margin: 20px 0;">
                    <div class="stat-item">
                        <div class="stat-number">${gradedCount}</div>
                        <div class="stat-label">Students Graded</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">${averageGrade}%</div>
                        <div class="stat-label">Class Average</div>
                    </div>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-primary" onclick="closeModal('gradingModal')">Done</button>
                </div>
            `;
        }

        function resetGradingForm() {
            document.getElementById('gradingClass').value = '';
            document.getElementById('gradingAssignment').innerHTML = '<option value="">Choose an assignment...</option>';
            document.getElementById('submissionsGrid').style.display = 'none';
        }

        // Message functions
        function addRecipient() {
            const select = document.getElementById('messageRecipient');
            const recipientsList = document.getElementById('recipientsList');
            const selectedValue = select.value;
            const selectedText = select.options[select.selectedIndex].text;

            if (selectedValue && !messageRecipients.includes(selectedValue)) {
                messageRecipients.push(selectedValue);
                
                const recipientTag = document.createElement('div');
                recipientTag.className = 'recipient-tag';
                recipientTag.innerHTML = `
                    ${selectedText}
                    <span class="remove" onclick="removeRecipient('${selectedValue}', this)">×</span>
                `;
                recipientsList.appendChild(recipientTag);
            }

            select.value = '';
        }

        function removeRecipient(value, element) {
            messageRecipients = messageRecipients.filter(r => r !== value);
            element.parentElement.remove();
        }

        function sendMessageSubmit() {
            const subject = document.getElementById('messageSubject').value;
            const content = document.getElementById('messageContent').value;

            if (!subject || !content || messageRecipients.length === 0) {
                alert('Please fill in all fields and select at least one recipient.');
                return;
            }

            // Show success message
            const modalContent = document.querySelector('#messageModal .modal-content');
            modalContent.innerHTML = `
                <div class="modal-header">
                    <h2>✅ Message Sent!</h2>
                    <button class="close-btn" onclick="closeModal('messageModal')">&times;</button>
                </div>
                <div class="success-message">
                    Your message "${subject}" has been successfully sent to ${messageRecipients.length} recipient(s).
                </div>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; margin: 15px 0;">
                    <strong>Message Summary:</strong><br>
                    <strong>Subject:</strong> ${subject}<br>
                    <strong>Recipients:</strong> ${messageRecipients.length}<br>
                    <strong>Sent:</strong> ${new Date().toLocaleString()}
                </div>
                <div class="modal-actions">
                    <button class="btn btn-primary" onclick="closeModal('messageModal')">Done</button>
                </div>
            `;
        }

        function resetMessageForm() {
            document.getElementById('messageRecipient').value = '';
            document.getElementById('messageSubject').value = '';
            document.getElementById('messageContent').value = '';
            document.getElementById('recipientsList').innerHTML = '';
            messageRecipients = [];
        }

        // Navigation functions
        function goHome() {
            alert('You are already on the home page!');
        }

        function viewGrades() {
            alert('Opening grades view...');
        }

        function viewCalendar() {
            alert('Opening calendar view...');
        }

        function viewMessages() {
            alert('Opening messages...');
        }

        // Helper functions
        function updateAttendanceStats() {
            // Simulate updating the main dashboard attendance stat
            const attendanceElement = document.getElementById('attendance');
            const currentAttendance = parseInt(attendanceElement.textContent);
            const newAttendance = Math.min(95, currentAttendance + Math.floor(Math.random() * 3));
            attendanceElement.textContent = newAttendance + '%';
        }

        // Dynamic content updates
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            console.log('Current time:', now.toLocaleDateString('en-US', options));
        }

        // Simulate real-time updates
        function simulateUpdates() {
            // Update attendance randomly
            const attendance = document.getElementById('attendance');
            const currentAttendance = parseInt(attendance.textContent);
            const newAttendance = Math.max(85, Math.min(98, currentAttendance + (Math.random() - 0.5) * 2));
            attendance.textContent = Math.round(newAttendance) + '%';

            // Update average grade
            const avgGrade = document.getElementById('avgGrade');
            const currentGrade = parseInt(avgGrade.textContent);
            const newGrade = Math.max(70, Math.min(95, currentGrade + (Math.random() - 0.5) * 3));
            avgGrade.textContent = Math.round(newGrade) + '%';
        }

        // Add click effects to cards
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.card').forEach(card => {
                card.addEventListener('click', function(e) {
                    if (!e.target.classList.contains('action-btn') && !e.target.closest('.action-btn')) {
                        this.style.transform = 'scale(1.02)';
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 150);
                    }
                });
            });

            // Add interactive features
            document.querySelectorAll('.class-item').forEach(item => {
                item.addEventListener('click', function() {
                    const className = this.querySelector('.class-name').textContent;
                    alert(`Opening ${className} details...`);
                });
            });

            document.querySelectorAll('.schedule-item').forEach(item => {
                item.addEventListener('click', function() {
                    const time = this.querySelector('.schedule-time').textContent;
                    const details = this.querySelector('.schedule-details h4').textContent;
                    alert(`${time} - ${details}\nClick to view full details.`);
                });
            });

            // Close modals when clicking outside
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal(this.id);
                    }
                });
            });

            // ESC key to close modals
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const activeModal = document.querySelector('.modal.active');
                    if (activeModal) {
                        closeModal(activeModal.id);
                    }
                }
            });
        });

        // Initialize
        updateDateTime();
        setInterval(updateDateTime, 60000); // Update every minute
        setInterval(simulateUpdates, 30000); // Update stats every 30 seconds

        // Add loading animation on page load
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Responsive navigation enhancement
        window.addEventListener('resize', function() {
            const navigation = document.querySelector('.navigation');
            if (window.innerWidth <= 768) {
                navigation.style.position = 'fixed';
                navigation.style.bottom = '10px';
                navigation.style.left = '10px';
                navigation.style.right = '10px';
            } else {
                navigation.style.position = 'fixed';
                navigation.style.bottom = '20px';
                navigation.style.right = '20px';
                navigation.style.left = 'auto';
            }
        });
    </script><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Rukara Model School</title>
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
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .school-info h1 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .school-info p {
            color: #7f8c8d;
            font-size: 1.1rem;
        }

        .teacher-info {
            text-align: right;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .teacher-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(45deg, #3498db, #2980b9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .teacher-details h3 {
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .teacher-details p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            transition: transform 0.2s ease;
        }

        .stat-item:hover {
            transform: scale(1.05);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .class-list {
            max-height: 200px;
            overflow-y: auto;
        }

        .class-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .class-item:hover {
            background: linear-gradient(135deg, #e9ecef, #dee2e6);
            transform: translateX(5px);
        }

        .class-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .student-count {
            background: #3498db;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            border-left: 4px solid #3498db;
            transition: all 0.2s ease;
        }

        .schedule-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .schedule-time {
            font-weight: bold;
            color: #2c3e50;
            min-width: 80px;
            margin-right: 15px;
        }

        .schedule-details h4 {
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .schedule-details p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .announcement-item {
            padding: 15px;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border-radius: 12px;
            border-left: 4px solid #f39c12;
            transition: all 0.2s ease;
        }

        .announcement-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .announcement-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .announcement-content {
            color: #5d4e75;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .announcement-date {
            color: #7f8c8d;
            font-size: 0.8rem;
            margin-top: 8px;
        }

        .quick-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-btn {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        .action-btn.secondary {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            box-shadow: 0 4px 15px rgba(149, 165, 166, 0.3);
        }

        .action-btn.secondary:hover {
            box-shadow: 0 8px 25px rgba(149, 165, 166, 0.4);
        }

        .navigation {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 15px 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            display: flex;
            gap: 15px;
        }

        .nav-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            transition: all 0.3s ease;
        }

        .nav-btn.home { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        .nav-btn.grades { background: linear-gradient(135deg, #f39c12, #e67e22); }
        .nav-btn.calendar { background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .nav-btn.messages { background: linear-gradient(135deg, #9b59b6, #8e44ad); }

        .nav-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .teacher-info {
                text-align: center;
            }

            .school-info h1 {
                font-size: 1.5rem;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .quick-actions {
                justify-content: center;
            }

            .navigation {
                bottom: 10px;
                right: 10px;
                left: 10px;
                justify-content: center;
                border-radius: 25px;
            }

            .action-btn {
                flex: 1;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .schedule-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .schedule-time {
                margin-bottom: 8px;
            }
        }
 /* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    border-radius: 20px;
    padding: 30px;
    max-width: 500px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f2f6;
        }

        .modal-header h2 {
            color: #2c3e50;
            margin: 0;
            font-size: 1.5rem;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #7f8c8d;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .close-btn:hover {
            background: #f1f2f6;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
        }

        .form-group select,
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group select:focus,
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .attendance-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .student-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .student-name {
            font-weight: 500;
            color: #2c3e50;
        }

        .attendance-options {
            display: flex;
            gap: 8px;
        }

        .attendance-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .attendance-btn.present {
            background: #2ecc71;
            color: white;
        }

        .attendance-btn.absent {
            background: #e74c3c;
            color: white;
        }

        .attendance-btn.late {
            background: #f39c12;
            color: white;
        }

        .attendance-btn:not(.active) {
            background: #ecf0f1;
            color: #7f8c8d;
        }

        .attendance-btn.active {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #f1f2f6;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        .btn-secondary {
            background: #ecf0f1;
            color: #7f8c8d;
        }

        .btn-secondary:hover {
            background: #d5dbdb;
            color: #2c3e50;
        }

        .assignment-type {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .type-option {
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .type-option:hover,
        .type-option.selected {
            border-color: #3498db;
            background: rgba(52, 152, 219, 0.1);
            color: #2980b9;
        }

        .message-recipients {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }

        .recipient-tag {
            background: #3498db;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .recipient-tag .remove {
            cursor: pointer;
            font-weight: bold;
        }

        .recipient-tag .remove:hover {
            color: #e74c3c;
        }

        .success-message {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease;
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="school-info">
                <h1>Rukara Model School</h1>
                <p>Excellence in Education • Teacher Portal</p>
            </div>
            <div class="teacher-info">
                <div class="teacher-details">
                    <h3 id="teacherName">Ms. Sarah Uwimana</h3>
                    <p>Mathematics & Science Department</p>
                </div>
                <div class="teacher-avatar" id="teacherAvatar">SU</div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Overview Stats -->
            <div class="card">
                <h3>
                    <div class="card-icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">📊</div>
                    Overview
                </h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number" id="totalStudents">156</div>
                        <div class="stat-label">Total Students</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="totalClasses">6</div>
                        <div class="stat-label">Classes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="avgGrade">78%</div>
                        <div class="stat-label">Average Grade</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="attendance">92%</div>
                        <div class="stat-label">Attendance</div>
                    </div>
                </div>
            </div>

            <!-- My Classes -->
            <div class="card">
                <h3>
                    <div class="card-icon" style="background: linear-gradient(135deg, #2ecc71, #27ae60);">🎓</div>
                    My Classes
                </h3>
                <div class="class-list" id="classList">
                    <div class="class-item">
                        <span class="class-name">Mathematics Grade 10A</span>
                        <span class="student-count">28 students</span>
                    </div>
                    <div class="class-item">
                        <span class="class-name">Mathematics Grade 10B</span>
                        <span class="student-count">26 students</span>
                    </div>
                    <div class="class-item">
                        <span class="class-name">Physics Grade 11A</span>
                        <span class="student-count">24 students</span>
                    </div>
                    <div class="class-item">
                        <span class="class-name">Physics Grade 11B</span>
                        <span class="student-count">25 students</span>
                    </div>
                    <div class="class-item">
                        <span class="class-name">Chemistry Grade 12A</span>
                        <span class="student-count">27 students</span>
                    </div>
                    <div class="class-item">
                        <span class="class-name">Chemistry Grade 12B</span>
                        <span class="student-count">26 students</span>
                    </div>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div class="card">
                <h3>
                    <div class="card-icon" style="background: linear-gradient(135deg, #f39c12, #e67e22);">📅</div>
                    Today's Schedule
                </h3>
                <div id="scheduleList">
                    <div class="schedule-item">
                        <div class="schedule-time">08:00</div>
                        <div class="schedule-details">
                            <h4>Mathematics Grade 10A</h4>
                            <p>Room 101 • Algebra & Equations</p>
                        </div>
                    </div>
                    <div class="schedule-item">
                        <div class="schedule-time">10:00</div>
                        <div class="schedule-details">
                            <h4>Physics Grade 11A</h4>
                            <p>Lab 201 • Motion & Forces</p>
                        </div>
                    </div>
                    <div class="schedule-item">
                        <div class="schedule-time">14:00</div>
                        <div class="schedule-details">
                            <h4>Chemistry Grade 12A</h4>
                            <p>Lab 301 • Organic Chemistry</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Announcements -->
            <div class="card">
                <h3>
                    <div class="card-icon" style="background: linear-gradient(135deg, #9b59b6, #8e44ad);">📢</div>
                    Announcements
                </h3>
                <div id="announcementsList">
                    <div class="announcement-item">
                        <div class="announcement-title">Parent-Teacher Conference</div>
                        <div class="announcement-content">
                            Scheduled for next Friday. Please prepare progress reports for all students.
                        </div>
                        <div class="announcement-date">June 5, 2025</div>
                    </div>
                    <div class="announcement-item">
                        <div class="announcement-title">Science Fair Preparation</div>
                        <div class="announcement-content">
                            Science fair projects are due next month. Please guide students in selecting topics.
                        </div>
                        <div class="announcement-date">June 3, 2025</div>
                    </div>
                    <div class="announcement-item">
                        <div class="announcement-title">New Laboratory Equipment</div>
                        <div class="announcement-content">
                            New microscopes and chemistry sets have arrived. Training session on Monday.
                        </div>
                        <div class="announcement-date">June 1, 2025</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <h3>
                    <div class="card-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">⚡</div>
                    Quick Actions
                </h3>
                <div class="quick-actions">
                    <button class="action-btn" onclick="takeAttendance()">Take Attendance</button>
                    <button class="action-btn secondary" onclick="gradeAssignments()">Grade Assignments</button>
                    <button class="action-btn" onclick="createAssignment()">Create Assignment</button>
                    <button class="action-btn secondary" onclick="sendMessage()">Send Message</button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card">
                <h3>
                    <div class="card-icon" style="background: linear-gradient(135deg, #34495e, #2c3e50);">🔔</div>
                    Recent Activity
                </h3>
                <div id="activityList">
                    <div class="schedule-item">
                        <div class="schedule-time">2h ago</div>
                        <div class="schedule-details">
                            <h4>Assignment Submitted</h4>
                            <p>25 students submitted Math homework</p>
                        </div>
                    </div>
                    <div class="schedule-item">
                        <div class="schedule-time">4h ago</div>
                        <div class="schedule-details">
                            <h4>Quiz Completed</h4>
                            <p>Physics Grade 11A - Forces Quiz</p>
                        </div>
                    </div>
                    <div class="schedule-item">
                        <div class="schedule-time">1d ago</div>
                        <div class="schedule-details">
                            <h4>Parent Message</h4>
                            <p>Mrs. Gasana asked about her daughter's progress</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Navigation -->
        <div class="navigation">
            <button class="nav-btn home" onclick="goHome()" title="Home">🏠</button>
            <button class="nav-btn grades" onclick="viewGrades()" title="Grades">📝</button>
            <button class="nav-btn calendar" onclick="viewCalendar()" title="Calendar">📅</button>
            <button class="nav-btn messages" onclick="viewMessages()" title="Messages">💬</button>
        </div>

        <!-- Modals -->
        <!-- Attendance Modal -->
        <div id="attendanceModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>📋 Take Attendance</h2>
                    <button class="close-btn" onclick="closeModal('attendanceModal')">&times;</button>
                </div>
                
                <div class="form-group">
                    <label for="attendanceClass">Select Class</label>
                    <select id="attendanceClass" onchange="loadStudents()">
                        <option value="">Choose a class...</option>
                        <option value="math-10a">Mathematics Grade 10A</option>
                        <option value="math-10b">Mathematics Grade 10B</option>
                        <option value="physics-11a">Physics Grade 11A</option>
                        <option value="physics-11b">Physics Grade 11B</option>
                        <option value="chemistry-12a">Chemistry Grade 12A</option>
                        <option value="chemistry-12b">Chemistry Grade 12B</option>
                    </select>
                </div>

                <div id="studentsGrid" class="attendance-grid" style="display: none;">
                    <!-- Students will be loaded here -->
                </div>

                <div class="modal-actions">
                    <button class="btn btn-secondary" onclick="closeModal('attendanceModal')">Cancel</button>
                    <button class="btn btn-primary" onclick="saveAttendance()">Save Attendance</button>
                </div>
            </div>
        </div>

        <!-- Assignment Modal -->
        <div id="assignmentModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>📝 Create Assignment</h2>
                    <button class="close-btn" onclick="closeModal('assignmentModal')">&times;</button>
                </div>

                <div class="form-group">
                    <label>Assignment Type</label>
                    <div class="assignment-type">
                        <div class="type-option" onclick="selectType(this, 'homework')">
                            📚<br>Homework
                        </div>
                        <div class="type-option" onclick="selectType(this, 'quiz')">
                            📋<br>Quiz
                        </div>
                        <div class="type-option" onclick="selectType(this, 'test')">
                            📊<br>Test
                        </div>
                        <div class="type-option" onclick="selectType(this, 'project')">
                            🎯<br>Project
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="assignmentTitle">Assignment Title</label>
                    <input type="text" id="assignmentTitle" placeholder="Enter assignment title...">
                </div>

                <div class="form-group">
                    <label for="assignmentClass">Select Class</label>
                    <select id="assignmentClass">
                        <option value="">Choose a class...</option>
                        <option value="math-10a">Mathematics Grade 10A</option>
                        <option value="math-10b">Mathematics Grade 10B</option>
                        <option value="physics-11a">Physics Grade 11A</option>
                        <option value="physics-11b">Physics Grade 11B</option>
                        <option value="chemistry-12a">Chemistry Grade 12A</option>
                        <option value="chemistry-12b">Chemistry Grade 12B</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="assignmentDue">Due Date</label>
                    <input type="datetime-local" id="assignmentDue">
                </div>

                <div class="form-group">
                    <label for="assignmentPoints">Total Points</label>
                    <input type="number" id="assignmentPoints" placeholder="100" min="1">
                </div>

                <div class="form-group">
                    <label for="assignmentDescription">Description</label>
                    <textarea id="assignmentDescription" placeholder="Enter assignment description and instructions..."></textarea>
                </div>

                <div class="modal-actions">
                    <button class="btn btn-secondary" onclick="closeModal('assignmentModal')">Cancel</button>
                    <button class="btn btn-primary" onclick="createAssignmentSubmit()">Create Assignment</button>
                </div>
            </div>
        </div>

        <!-- Grading Modal -->
        <div id="gradingModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>📊 Grade Assignments</h2>
                    <button class="close-btn" onclick="closeModal('gradingModal')">&times;</button>
                </div>

                <div class="form-group">
                    <label for="gradingClass">Select Class</label>
                    <select id="gradingClass" onchange="loadAssignments()">
                        <option value="">Choose a class...</option>
                        <option value="math-10a">Mathematics Grade 10A</option>
                        <option value="math-10b">Mathematics Grade 10B</option>
                        <option value="physics-11a">Physics Grade 11A</option>
                        <option value="physics-11b">Physics Grade 11B</option>
                        <option value="chemistry-12a">Chemistry Grade 12A</option>
                        <option value="chemistry-12b">Chemistry Grade 12B</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gradingAssignment">Select Assignment</label>
                    <select id="gradingAssignment" onchange="loadSubmissions()">
                        <option value="">Choose an assignment...</option>
                    </select>
                </div>

                <div id="submissionsGrid" style="display: none;">
                    <h3>Student Submissions</h3>
                    <div id="submissionsList" class="attendance-grid">
                        <!-- Submissions will be loaded here -->
                    </div>
                </div>

                <div class="modal-actions">
                    <button class="btn btn-secondary" onclick="closeModal('gradingModal')">Cancel</button>
                    <button class="btn btn-primary" onclick="saveGrades()">Save Grades</button>
                </div>
            </div>
        </div>

        <!-- Message Modal -->
        <div id="messageModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>💬 Send Message</h2>
                    <button class="close-btn" onclick="closeModal('messageModal')">&times;</button>
                </div>

                <div class="form-group">
                    <label for="messageRecipient">Add Recipients</label>
                    <select id="messageRecipient" onchange="addRecipient()">
                        <option value="">Select recipient...</option>
                        <option value="parents-math-10a">Parents - Math Grade 10A</option>
                        <option value="parents-math-10b">Parents - Math Grade 10B</option>
                        <option value="parents-physics-11a">Parents - Physics Grade 11A</option>
                        <option value="parents-physics-11b">Parents - Physics Grade 11B</option>
                        <option value="parents-chemistry-12a">Parents - Chemistry Grade 12A</option>
                        <option value="parents-chemistry-12b">Parents - Chemistry Grade 12B</option>
                        <option value="administration">School Administration</option>
                        <option value="all-parents">All Parents</option>
                    </select>
                </div>

                <div id="recipientsList" class="message-recipients">
                    <!-- Recipients will appear here -->
                </div>

                <div class="form-group">
                    <label for="messageSubject">Subject</label>
                    <input type="text" id="messageSubject" placeholder="Enter message subject...">
                </div>

                <div class="form-group">
                    <label for="messageContent">Message</label>
                    <textarea id="messageContent" placeholder="Enter your message..." style="min-height: 150px;"></textarea>
                </div>

                <div class="modal-actions">
                    <button class="btn btn-secondary" onclick="closeModal('messageModal')">Cancel</button>
                    <button class="btn btn-primary" onclick="sendMessageSubmit()">Send Message</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dynamic content updates
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            console.log('Current time:', now.toLocaleDateString('en-US', options));
        }

        // Quick Actions
        function takeAttendance() {
            alert('Opening attendance system...');
            // In a real application, this would redirect to attendance page
        }

        function gradeAssignments() {
            alert('Opening assignment grading...');
            // In a real application, this would redirect to grading page
        }

        function createAssignment() {
            alert('Opening assignment creator...');
            // In a real application, this would redirect to assignment creation page
        }

        function sendMessage() {
            alert('Opening messaging system...');
            // In a real application, this would redirect to messaging page
        }

        // Navigation
        function goHome() {
            alert('You are already on the home page!');
        }

        function viewGrades() {
            alert('Opening grades view...');
            // In a real application, this would redirect to grades page
        }

        function viewCalendar() {
            alert('Opening calendar view...');
            // In a real application, this would redirect to calendar page
        }

        function viewMessages() {
            alert('Opening messages...');
            // In a real application, this would redirect to messages page
        }

        // Simulate real-time updates
        function simulateUpdates() {
            // Update attendance randomly
            const attendance = document.getElementById('attendance');
            const currentAttendance = parseInt(attendance.textContent);
            const newAttendance = Math.max(85, Math.min(98, currentAttendance + (Math.random() - 0.5) * 2));
            attendance.textContent = Math.round(newAttendance) + '%';

            // Update average grade
            const avgGrade = document.getElementById('avgGrade');
            const currentGrade = parseInt(avgGrade.textContent);
            const newGrade = Math.max(70, Math.min(95, currentGrade + (Math.random() - 0.5) * 3));
            avgGrade.textContent = Math.round(newGrade) + '%';
        }

        // Add click effects to cards
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.classList.contains('action-btn')) {
                    this.style.transform = 'scale(1.02)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                }
            });
        });

        // Initialize
        updateDateTime();
        setInterval(updateDateTime, 60000); // Update every minute
        setInterval(simulateUpdates, 30000); // Update stats every 30 seconds

        // Add some interactive features
        document.querySelectorAll('.class-item').forEach(item => {
            item.addEventListener('click', function() {
                const className = this.querySelector('.class-name').textContent;
                alert(`Opening ${className} details...`);
            });
        });

        document.querySelectorAll('.schedule-item').forEach(item => {
            item.addEventListener('click', function() {
                const time = this.querySelector('.schedule-time').textContent;
                const details = this.querySelector('.schedule-details h4').textContent;
                alert(`${time} - ${details}\nClick to view full details.`);
            });
        });

        // Add loading animation on page load
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Responsive navigation enhancement
        window.addEventListener('resize', function() {
            const navigation = document.querySelector('.navigation');
            if (window.innerWidth <= 768) {
                navigation.style.position = 'fixed';
                navigation.style.bottom = '10px';
                navigation.style.left = '10px';
                navigation.style.right = '10px';
            } else {
                navigation.style.position = 'fixed';
                navigation.style.bottom = '20px';
                navigation.style.right = '20px';
                navigation.style.left = 'auto';
            }
        });
        // Add this to your existing JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Modal functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    // Quick Actions
    document.querySelector('[onclick="takeAttendance()"]').onclick = function() {
        openModal('attendanceModal');
    };

    document.querySelector('[onclick="gradeAssignments()"]').onclick = function() {
        openModal('gradingModal');
    };

    document.querySelector('[onclick="createAssignment()"]').onclick = function() {
        openModal('assignmentModal');
    };

    document.querySelector('[onclick="sendMessage()"]').onclick = function() {
        openModal('messageModal');
    };

    // Close buttons
    document.querySelectorAll('.close-btn').forEach(btn => {
        btn.onclick = function() {
            const modal = this.closest('.modal');
            if (modal) {
                closeModal(modal.id);
            }
        };
    });

    // Close on outside click
    document.querySelectorAll('.modal').forEach(modal => {
        modal.onclick = function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        };
    });

    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal[style*="display: flex"]');
            if (activeModal) {
                closeModal(activeModal.id);
            }
        }
    });
});
    </script>
</body>
</html>