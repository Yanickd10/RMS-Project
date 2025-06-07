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
    <title>Student Portal - Learning Hub</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            text-align: center;
            color: #4a5568;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .user-info {
            text-align: center;
            color: #666;
            font-size: 1.1rem;
        }

        .nav-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
        }

        .tab-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            font-weight: 500;
        }

        .tab-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .tab-btn.active {
            background: rgba(255, 255, 255, 0.9);
            color: #4a5568;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .tab-content {
            display: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            font-size: 1.8rem;
            color: #2d3748;
            margin-bottom: 20px;
            text-align: center;
        }

        .upload-area {
            border: 3px dashed #cbd5e0;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            background: #f7fafc;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            border-color: #667eea;
            background: #edf2f7;
        }

        .upload-area.dragover {
            border-color: #667eea;
            background: #e6fffa;
        }

        .file-input {
            display: none;
        }

        .upload-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d3748;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .document-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .document-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .document-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .document-meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .download-btn {
            background: #48bb78;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .download-btn:hover {
            background: #38a169;
            transform: translateY(-1px);
        }

      

        .assignment-item {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #667eea;
        }

        .assignment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .assignment-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
        }

        .assignment-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fed7d7;
            color: #c53030;
        }

        .status-submitted {
            background: #c6f6d5;
            color: #2f855a;
        }

        .rating-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }

        .stars {
            display: flex;
            gap: 5px;
        }

        .star {
            font-size: 1.5rem;
            color: #e2e8f0;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .star:hover,
        .star.active {
            color: #ffd700;
        }

        .teachers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .teacher-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .teacher-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .teacher-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
        }

        .support-form {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: #c6f6d5;
            color: #2f855a;
            border: 1px solid #9ae6b4;
        }

        .alert-info {
            background: #bee3f8;
            color: #2c5282;
            border: 1px solid #90cdf4;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #48bb78, #38a169);
            transition: width 0.3s ease;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .nav-tabs {
                flex-direction: column;
                align-items: center;
            }

            .tab-btn {
                width: 200px;
                text-align: center;
            }

            .documents-grid,
            .teachers-grid {
                grid-template-columns: 1fr;
            }

            .assignment-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        .reflection-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .hidden {
            display: none;
        }
        #logoutbtn{
            background:rgb(240, 101, 50);
            /* color: black; */
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: bolder;
             cursor: pointer;
            text-decoration: none;
        } 
           #logoutbtn:hover{

            background:rgb(237, 127, 90); 
        } 
        #logoutbtn a{ 
            color: black;
            text-decoration: none;
              font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
             <button id="logoutbtn"><a href="#" class="nav-item" onclick="logout()">
        <span>Logout</span>
        </a></button>
            <h1>🎓 Student Learning Portal</h1>
            <div class="user-info">
               <strong>Welcome back, <?php echo htmlspecialchars($userName); ?> (<?php echo $userRole; ?>)</strong>
            </div> 
       
        </div>

        <div class="nav-tabs">
            <button class="tab-btn active" onclick="showTab('assignments')">📝 Assignments</button>
            <button class="tab-btn" onclick="showTab('documents')">📄 Documents</button>
            <button class="tab-btn" onclick="showTab('support')">💬 Support</button>
            <button class="tab-btn" onclick="showTab('reflections')">💭 Reflections</button>
            <button class="tab-btn" onclick="showTab('ratings')">⭐ Rate Teachers</button>
        </div>

        <!-- Assignments Tab -->
        <div id="assignments" class="tab-content active">
            <h2 class="section-title">📝 Assignment Management</h2>
            
            <div class="upload-area" id="uploadArea">
                <h3>Upload Assignment</h3>
                <p>Drag and drop your files here or click to browse</p>
                <input type="file" id="assignmentFile" class="file-input" multiple accept=".pdf,.doc,.docx,.txt,.jpg,.png">
                <button class="upload-btn" onclick="document.getElementById('assignmentFile').click()">
                    Choose Files
                </button>
            </div>

            <div class="form-group">
                <label for="assignmentTitle">Assignment Title:</label>
                <input type="text" id="assignmentTitle" class="form-control" placeholder="Enter assignment title">
            </div>

            <div class="form-group">
                <label for="assignmentNotes">Notes (Optional):</label>
                <textarea id="assignmentNotes" class="form-control" rows="3" placeholder="Add any notes about your assignment"></textarea>
            </div>

            <button class="btn-primary" onclick="submitAssignment()">Submit Assignment</button>

            <div id="assignmentAlert" class="hidden"></div>

            <h3 style="margin-top: 40px; color: #2d3748;">My Submitted Assignments</h3>
            <div class="assignments-list" id="assignmentsList">
                <div class="assignment-item">
                    <div class="assignment-header">
                        <div class="assignment-title">Mathematics Assignment #3</div>
                        <div class="assignment-status status-submitted">Submitted</div>
                    </div>
                    <p><strong>Subject:</strong> Advanced Calculus</p>
                    <p><strong>Submitted:</strong> May 20, 2025</p>
                    <p><strong>Grade:</strong> A- (88/100)</p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 88%"></div>
                    </div>
                </div>

                <div class="assignment-item">
                    <div class="assignment-header">
                        <div class="assignment-title">History Essay - World War II</div>
                        <div class="assignment-status status-pending">Pending Review</div>
                    </div>
                    <p><strong>Subject:</strong> Modern History</p>
                    <p><strong>Submitted:</strong> May 22, 2025</p>
                    <p><strong>Status:</strong> Under review by Teacher name</p>
                </div>
            </div>
        </div>

        <!-- Documents Tab -->
        <div id="documents" class="tab-content">
            <h2 class="section-title">📄 Course Documents</h2>
            
            <div class="documents-grid">
                <div class="document-card">
                    <div class="document-title">📊 Statistics Lecture Notes</div>
                    <div class="document-meta">
                        <p><strong>Course:</strong> STAT 301</p>
                        <p><strong>Professor:</strong> Dr. Smith</p>
                        <p><strong>Updated:</strong> May 18, 2025</p>
                        <p><strong>Size:</strong> 2.3 MB</p>
                    </div>
                    <button class="download-btn" onclick="downloadDocument('statistics_notes.pdf')">
                        ⬇️ Download
                    </button>
                </div>

                <div class="document-card">
                    <div class="document-title">🔬 Chemistry Lab Manual</div>
                    <div class="document-meta">
                        <p><strong>Course:</strong> CHEM 201</p>
                        <p><strong>Professor:</strong> Dr. Wilson</p>
                        <p><strong>Updated:</strong> May 15, 2025</p>
                        <p><strong>Size:</strong> 5.1 MB</p>
                    </div>
                    <button class="download-btn" onclick="downloadDocument('chemistry_manual.pdf')">
                        ⬇️ Download
                    </button>
                </div>

                <div class="document-card">
                    <div class="document-title">📚 Literature Reading List</div>
                    <div class="document-meta">
                        <p><strong>Course:</strong> ENG 102</p>
                        <p><strong>Professor:</strong> Prof. Davis</p>
                        <p><strong>Updated:</strong> May 20, 2025</p>
                        <p><strong>Size:</strong> 1.2 MB</p>
                    </div>
                    <button class="download-btn" onclick="downloadDocument('reading_list.pdf')">
                        ⬇️ Download
                    </button>
                </div>
                <div class="document-card">
                    <div class="document-title">🏛️ History Timeline</div>
                    <div class="document-meta">
                        <p><strong>Course:</strong> HIST 205</p>
                        <p><strong>Professor:</strong> Teacher name</p>
                        <p><strong>Updated:</strong> May 19, 2025</p>
                        <p><strong>Size:</strong> 3.7 MB</p>
                    </div>
                    <button class="download-btn" onclick="downloadDocument('history_timeline.pdf')">
                        ⬇️ Download
                    </button>
                </div>
            </div>
        </div>

        <!-- Support Tab -->
        <div id="support" class="tab-content">
            <h2 class="section-title">💬 Ask for Support</h2>
            
            <div class="support-form">
                <div class="form-group">
                    <label for="supportSubject">Subject:</label>
                    <select id="supportSubject" class="form-control">
                        <option value="">Select a subject...</option>
                        <option value="academic">Academic Help</option>
                        <option value="technical">Technical Issues</option>
                        <option value="assignment">Assignment Questions</option>
                        <option value="general">General Inquiry</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="supportTitle">Title:</label>
                    <input type="text" id="supportTitle" class="form-control" placeholder="Brief description of your issue">
                </div>

                <div class="form-group">
                    <label for="supportMessage">Message:</label>
                    <textarea id="supportMessage" class="form-control" rows="5" placeholder="Describe your question or issue in detail..."></textarea>
                </div>

                <div class="form-group">
                    <label for="supportPriority">Priority:</label>
                    <select id="supportPriority" class="form-control">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>

                <button class="btn-primary" onclick="submitSupport()">Submit Support Request</button>
            </div>

            <div id="supportAlert" class="hidden"></div>

            <h3 style="color: #2d3748; margin-bottom: 20px;">Recent Support Tickets</h3>
            <div class="assignment-item">
                <div class="assignment-header">
                    <div class="assignment-title">Assignment Submission Issue</div>
                    <div class="assignment-status" style="background: #fef2c7; color: #d69e2e;">In Progress</div>
                </div>
                <p><strong>Created:</strong> May 23, 2025</p>
                <p><strong>Last Update:</strong> May 24, 2025</p>
                <p>Support team is investigating upload issues with PDF files.</p>
            </div>
        </div>

        <!-- Reflections Tab -->
        <div id="reflections" class="tab-content">
            <h2 class="section-title">💭 Course Reflections</h2>
            
            <div class="support-form">
                <div class="form-group">
                    <label for="reflectionCourse">Course:</label>
                    <select id="reflectionCourse" class="form-control">
                        <option value="">Select a course...</option>
                        <option value="STAT301">Statistics 301</option>
                        <option value="CHEM201">Chemistry 201</option>
                        <option value="ENG102">Literature 102</option>
                        <option value="HIST205">History 205</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="reflectionTitle">Reflection Title:</label>
                    <input type="text" id="reflectionTitle" class="form-control" placeholder="What did you learn?">
                </div>

                <div class="form-group">
                    <label for="reflectionContent">Your Reflection:</label>
                    <textarea id="reflectionContent" class="form-control" rows="6" placeholder="Share your thoughts about what you've learned, challenges faced, and insights gained..."></textarea>
                </div>

                <div class="form-group">
                    <label>How would you rate this learning experience?</label>
                    <div class="rating-container">
                        <div class="stars" id="learningRating">
                            <span class="star" data-rating="1">★</span>
                            <span class="star" data-rating="2">★</span>
                            <span class="star" data-rating="3">★</span>
                            <span class="star" data-rating="4">★</span>
                            <span class="star" data-rating="5">★</span>
                        </div>
                        <span id="ratingText">Rate your experience</span>
                    </div>
                </div>

                <button class="btn-primary" onclick="submitReflection()">Save Reflection</button>
            </div>

            <div id="reflectionAlert" class="hidden"></div>

            <h3 style="color: #2d3748; margin: 30px 0 20px;">My Previous Reflections</h3>
            <div class="reflection-card">
                <h4 style="color: #2d3748; margin-bottom: 10px;">Understanding Calculus Concepts</h4>
                <p><strong>Course:</strong> Statistics 301 | <strong>Date:</strong> May 20, 2025</p>
                <p style="margin-top: 15px;">This week's lessons on derivatives really clicked for me. The practical applications in economics helped me understand why we need to calculate rates of change. I struggled initially with the chain rule, but the practice problems made it clearer...</p>
                <div class="rating-container">
                    <div class="stars">
                        <span class="star active">★</span>
                        <span class="star active">★</span>
                        <span class="star active">★</span>
                        <span class="star active">★</span>
                        <span class="star">★</span>
                    </div>
                    <span>4/5 stars</span>
                </div>
            </div>
        </div>

        <!-- Ratings Tab -->
        <div id="ratings" class="tab-content">
            <h2 class="section-title">⭐ Rate Your Teachers</h2>
            
            <div class="teachers-grid">
                <div class="teacher-card">
                    <div class="teacher-avatar">DS</div>
                    <h3 style="color: #2d3748; margin-bottom: 5px;">Dr. Sarah Smith</h3>
                    <p style="color: #666; margin-bottom: 15px;">Statistics 301</p>
                    
                    <div style="text-align: left; margin-bottom: 15px;">
                        <p><strong>Teaching Quality:</strong></p>
                        <div class="rating-container">
                            <div class="stars" data-teacher="smith-teaching">
                                <span class="star" data-rating="1">★</span>
                                <span class="star" data-rating="2">★</span>
                                <span class="star" data-rating="3">★</span>
                                <span class="star" data-rating="4">★</span>
                                <span class="star" data-rating="5">★</span>
                            </div>
                        </div>
                        
                        <p><strong>Helpfulness:</strong></p>
                        <div class="rating-container">
                            <div class="stars" data-teacher="smith-help">
                                <span class="star" data-rating="1">★</span>
                                <span class="star" data-rating="2">★</span>
                                <span class="star" data-rating="3">★</span>
                                <span class="star" data-rating="4">★</span>
                                <span class="star" data-rating="5">★</span>
                            </div>
                        </div>
                    </div>
                    
                    <textarea class="form-control" placeholder="Leave a comment about Dr. Smith..." rows="3" style="margin-bottom: 10px;"></textarea>
                    <button class="btn-primary" onclick="submitTeacherRating('smith')">Submit Rating</button>
                </div>

                <div class="teacher-card">
                    <div class="teacher-avatar">MW</div>
                    <h3 style="color: #2d3748; margin-bottom: 5px;">Dr. Michael Wilson</h3>
                    <p style="color: #666; margin-bottom: 15px;">Chemistry 201</p>
                    
                    <div style="text-align: left; margin-bottom: 15px;">
                        <p><strong>Teaching Quality:</strong></p>
                        <div class="rating-container">
                            <div class="stars" data-teacher="wilson-teaching">
                                <span class="star" data-rating="1">★</span>
                                <span class="star" data-rating="2">★</span>
                                <span class="star" data-rating="3">★</span>
                                <span class="star" data-rating="4">★</span>
                                <span class="star" data-rating="5">★</span>
                            </div>
                        </div>
                        
                        <p><strong>Helpfulness:</strong></p>
                        <div class="rating-container">
                            <div class="stars" data-teacher="wilson-help">
                                <span class="star" data-rating="1">★</span>
                                <span class="star" data-rating="2">★</span>
                                <span class="star" data-rating="3">★</span>
                                <span class="star" data-rating="4">★</span>
                                <span class="star" data-rating="5">★</span>
                            </div>
                        </div>
                    </div>
                    
                    <textarea class="form-control" placeholder="Leave a comment about Dr. Wilson..." rows="3" style="margin-bottom: 10px;"></textarea>
                    <button class="btn-primary" onclick="submitTeacherRating('wilson')">Submit Rating</button>
                </div>

                <div class="teacher-card">
                    <div class="teacher-avatar">LD</div>
                    <h3 style="color: #2d3748; margin-bottom: 5px;">Prof. Lisa Davis</h3>
                    <p style="color: #666; margin-bottom: 15px;">Literature 102</p>
                    
                    <div style="text-align: left; margin-bottom: 15px;">
                        <p><strong>Teaching Quality:</strong></p>
                        <div class="rating-container">
                            <div class="stars" data-teacher="davis-teaching">
                                <span class="star" data-rating="1">★</span>
                                <span class="star" data-rating="2">★</span>
                                <span class="star" data-rating="3">★</span>
                                <span class="star" data-rating="4">★</span>
                                <span class="star" data-rating="5">★</span>
                            </div>
                        </div>
                        
                        <p><strong>Helpfulness:</strong></p>
                        <div class="rating-container">
                            <div class="stars" data-teacher="davis-help">
                                <span class="star" data-rating="1">★</span>
                                <span class="star" data-rating="2">★</span>
                                <span class="star" data-rating="3">★</span>
                                <span class="star" data-rating="4">★</span>
                                <span class="star" data-rating="5">★</span>
                            </div>
                        </div>
                    </div>
                    
                    <textarea class="form-control" placeholder="Leave a comment about Prof. Davis..." rows="3" style="margin-bottom: 10px;"></textarea>
                    <button class="btn-primary" onclick="submitTeacherRating('davis')">Submit Rating</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        function showTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(tab => {
                tab.classList.remove('active');
            });

            // Remove active class from all tab buttons
            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab content
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked button
            event.target.classList.add('active');
        }

        // File upload functionality
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('assignmentFile');

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            const fileList = Array.from(files).map(file => file.name).join(', ');
            uploadArea.innerHTML = `
                <h3>Files Selected</h3>
                <p>${fileList}</p>
                <button class="upload-btn" onclick="document.getElementById('assignmentFile').click()">
                    Change Files
                </button>
            `;
        }

        // Assignment submission
        function submitAssignment() {
            const title = document.getElementById('assignmentTitle').value;
            const notes = document.getElementById('assignmentNotes').value;
            const files = document.getElementById('assignmentFile').files;

            if (!title.trim()) {
                showAlert('assignmentAlert', 'Please enter an assignment title.', 'error');
                return;
            }

            if (files.length === 0) {
                showAlert('assignmentAlert', 'Please select at least one file to upload.', 'error');
                return;
            }

            // Simulate assignment submission
            showAlert('assignmentAlert', 'Assignment submitted successfully! You will receive confirmation shortly.', 'success');
            
            // Reset form
            document.getElementById('assignmentTitle').value = '';
            document.getElementById('assignmentNotes').value = '';
            document.getElementById('assignmentFile').value = '';
            resetUploadArea();

            // Add to assignments list
            addSubmittedAssignment(title, files[0].name);
        }

        function resetUploadArea() {
            uploadArea.innerHTML = `
                <h3>Upload Assignment</h3>
                <p>Drag and drop your files here or click to browse</p>
                <input type="file" id="assignmentFile" class="file-input" multiple accept=".pdf,.doc,.docx,.txt,.jpg,.png">
                <button class="upload-btn" onclick="document.getElementById('assignmentFile').click()">
                    Choose Files
                </button>
            `;
        }

        function addSubmittedAssignment(title, filename) {
            const assignmentsList = document.getElementById('assignmentsList');
            const currentDate = new Date().toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });

            const newAssignment = document.createElement('div');
            newAssignment.className = 'assignment-item';
            newAssignment.innerHTML = `
                <div class="assignment-header">
                    <div class="assignment-title">${title}</div>
                    <div class="assignment-status status-pending">Just Submitted</div>
                </div>
                <p><strong>File:</strong> ${filename}</p>
                <p><strong>Submitted:</strong> ${currentDate}</p>
                <p><strong>Status:</strong> Awaiting review</p>
            `;

            assignmentsList.insertBefore(newAssignment, assignmentsList.firstChild);
        }

        // Document download functionality
        function downloadDocument(filename) {
            // Simulate document download
            showAlert('documentAlert', `Downloading ${filename}...`, 'info');
            
            // In a real application, this would trigger an actual download
            setTimeout(() => {
                showAlert('documentAlert', `${filename} downloaded successfully!`, 'success');
            }, 1500);
        }

        // Support request submission
        function submitSupport() {
            const subject = document.getElementById('supportSubject').value;
            const title = document.getElementById('supportTitle').value;
            const message = document.getElementById('supportMessage').value;
            const priority = document.getElementById('supportPriority').value;

            if (!subject || !title.trim() || !message.trim()) {
                showAlert('supportAlert', 'Please fill in all required fields.', 'error');
                return;
            }

            // Simulate support ticket creation
            showAlert('supportAlert', 'Support request submitted successfully! Ticket #SUP2025-' + 
                     Math.floor(Math.random() * 1000) + ' has been created.', 'success');

            // Reset form
            document.getElementById('supportSubject').value = '';
            document.getElementById('supportTitle').value = '';
            document.getElementById('supportMessage').value = '';
            document.getElementById('supportPriority').value = 'medium';
        }

        // Reflection submission
        let selectedLearningRating = 0;

        // Initialize learning rating stars
        document.addEventListener('DOMContentLoaded', () => {
            const learningStars = document.querySelectorAll('#learningRating .star');
            learningStars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    selectedLearningRating = index + 1;
                    updateLearningStars();
                });

                star.addEventListener('mouseover', () => {
                    highlightLearningStars(index + 1);
                });
            });

            document.getElementById('learningRating').addEventListener('mouseleave', () => {
                updateLearningStars();
            });
        });

        function highlightLearningStars(rating) {
            const stars = document.querySelectorAll('#learningRating .star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function updateLearningStars() {
            const stars = document.querySelectorAll('#learningRating .star');
            const ratingText = document.getElementById('ratingText');
            
            stars.forEach((star, index) => {
                if (index < selectedLearningRating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });

            const ratingTexts = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];
            ratingText.textContent = selectedLearningRating > 0 ? 
                `${selectedLearningRating}/5 - ${ratingTexts[selectedLearningRating]}` : 
                'Rate your experience';
        }

        function submitReflection() {
            const course = document.getElementById('reflectionCourse').value;
            const title = document.getElementById('reflectionTitle').value;
            const content = document.getElementById('reflectionContent').value;

            if (!course || !title.trim() || !content.trim()) {
                showAlert('reflectionAlert', 'Please fill in all required fields.', 'error');
                return;
            }

            if (selectedLearningRating === 0) {
                showAlert('reflectionAlert', 'Please rate your learning experience.', 'error');
                return;
            }

            // Simulate reflection submission
            showAlert('reflectionAlert', 'Reflection saved successfully! Thank you for sharing your insights.', 'success');

            // Reset form
            document.getElementById('reflectionCourse').value = '';
            document.getElementById('reflectionTitle').value = '';
            document.getElementById('reflectionContent').value = '';
            selectedLearningRating = 0;
            updateLearningStars();
        }

        // Teacher rating functionality
        const teacherRatings = {};

        document.addEventListener('DOMContentLoaded', () => {
            // Initialize all teacher rating stars
            const ratingContainers = document.querySelectorAll('.stars[data-teacher]');
            ratingContainers.forEach(container => {
                const teacherId = container.getAttribute('data-teacher');
                const stars = container.querySelectorAll('.star');
                
                stars.forEach((star, index) => {
                    star.addEventListener('click', () => {
                        teacherRatings[teacherId] = index + 1;
                        updateTeacherStars(container, index + 1);
                    });

                    star.addEventListener('mouseover', () => {
                        highlightTeacherStars(container, index + 1);
                    });
                });

                container.addEventListener('mouseleave', () => {
                    const currentRating = teacherRatings[teacherId] || 0;
                    updateTeacherStars(container, currentRating);
                });
            });
        });

        function highlightTeacherStars(container, rating) {
            const stars = container.querySelectorAll('.star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function updateTeacherStars(container, rating) {
            const stars = container.querySelectorAll('.star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }
        function logout() {
            window.location.href = "/RMS-Project/includes/logout";
        }

        function submitTeacherRating(teacherId) {
            const teachingRating = teacherRatings[`${teacherId}-teaching`] || 0;
            const helpRating = teacherRatings[`${teacherId}-help`] || 0;

            if (teachingRating === 0 || helpRating === 0) {
                alert('Please rate both teaching quality and helpfulness.');
                return;
            }

            // Get comment
            const teacherCard = event.target.closest('.teacher-card');
            const comment = teacherCard.querySelector('textarea').value;

            // Simulate rating submission
            const teacherNames = {
                'smith': 'Dr. Sarah Smith',
                'wilson': 'Dr. Michael Wilson',
                'davis': 'Prof. Lisa Davis'
            };

            alert(`Rating submitted for ${teacherNames[teacherId]}!\nTeaching: ${teachingRating}/5\nHelpfulness: ${helpRating}/5\nThank you for your feedback!`);

            // Reset comment
            teacherCard.querySelector('textarea').value = '';
        }

        // Alert system
        function showAlert(alertId, message, type) {
            const alertElement = document.getElementById(alertId);
            const alertClass = type === 'success' ? 'alert-success' : 
                              type === 'error' ? 'alert-error' : 'alert-info';
            
            alertElement.className = `alert ${alertClass}`;
            alertElement.textContent = message;
            alertElement.classList.remove('hidden');

            // Auto-hide after 5 seconds
            setTimeout(() => {
                alertElement.classList.add('hidden');
            }, 5000);
        }

        // Add CSS for error alerts
        const style = document.createElement('style');
        style.textContent = `
            .alert-error {
                background: #fed7d7;
                color: #c53030;
                border: 1px solid #feb2b2;
            }
        `;
        document.head.appendChild(style);

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            // Show welcome message
            setTimeout(() => {
                console.log('Student Portal loaded successfully!');
            }, 1000);
        });
    </script>
</body>
</html>