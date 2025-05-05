<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academics - Rukara Model School</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #f1c40f;
            --bg: #f9f9f9;
            --white: #fff;
            --shadow: 0 2px 8px rgba(44,62,80,0.08);
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background: var(--bg);
            color: var(--primary);
            margin: 0;
        }
        header {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 2rem 0 1rem 0;
            text-align: center;
            box-shadow: var(--shadow);
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
            letter-spacing: 2px;
        }
        nav {
            background: var(--primary);
            box-shadow: var(--shadow);
        }
        header, nav{
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
        }
        .nav-logo {
            font-weight: bold;
            font-size: 1.3rem;
            color: var(--accent);
            letter-spacing: 1px;
        }
        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-links a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background 0.2s;
        }
        .nav-links a:hover, .nav-links .active {
            background: var(--secondary);
        }
        .menu-toggle {
            display: none;
            font-size: 2rem;
            color: var(--white);
            cursor: pointer;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
        }
        .section {
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            padding: 2rem;
        }
        .section h2 {
            color: var(--secondary);
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--accent);
            padding-bottom: 0.5rem;
        }
        .subsection {
            margin: 1.5rem 0;
        }
        .subsection h3 {
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        .requirements-list {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }
        .requirements-card {
            background: var(--bg);
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 1rem 1.5rem;
            flex: 1 1 250px;
            min-width: 220px;
        }
        .requirements-card h4 {
            color: var(--secondary);
            margin-top: 0;
        }
        .courses-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
        .course-card {
            background: var(--bg);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .course-card h3 {
            margin-top: 0;
            color: var(--primary);
        }
        .download-link {
            margin-top: 1rem;
            color: var(--secondary);
            text-decoration: underline;
            font-size: 0.95rem;
        }
        .calendar-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .calendar-table th, .calendar-table td {
            border: 1px solid #e1e1e1;
            padding: 0.75rem;
            text-align: left;
        }
        .calendar-table th {
            background: var(--secondary);
            color: var(--white);
        }
        .calendar-table tr:nth-child(even) {
            background: #f4f8fb;
        }
        /* Apply Online Form */
        .apply-form {
            background: var(--bg);
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 2rem;
            max-width: 500px;
            margin: 2rem auto 0 auto;
        }
        .apply-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .apply-form input, .apply-form select, .apply-form textarea {
            width: 100%;
            padding: 0.7rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: inherit;
        }
        .apply-form button {
            background: var(--secondary);
            color: var(--white);
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.2s;
        }
        .apply-form button:hover {
            background: var(--primary);
        }
        .apply-info {
            background: #eaf6fb;
            border-left: 4px solid var(--secondary);
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            border-radius: 6px;
        }
        /* Responsive */
        @media (max-width: 900px) {
            .container { padding: 0.5rem; }
            .section { padding: 1rem; }
        }
        @media (max-width: 700px) {
            .nav-container { flex-direction: column; align-items: flex-start; }
            .nav-links { flex-direction: column; width: 100%; gap: 0; }
            .nav-links li { width: 100%; }
            .nav-links a { display: block; width: 100%; }
            .menu-toggle { display: block; }
            .nav-links { display: none; }
            .nav-links.open { display: flex; }
        }
        @media (max-width: 500px) {
            header h1 { font-size: 1.5rem; }
            .section { padding: 0.7rem; }
            .apply-form { padding: 1rem; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Academics</h1>
    </header>
    <nav>
        <div class="nav-container">
            <div class="nav-logo"> <svg onclick="window.location.href = '/RMS-Project/index'" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
  <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
</svg> </div>
            <div class="menu-toggle" id="menuToggle">&#9776;</div>
            <ul class="nav-links" id="navLinks">
                <li><a href="#admissions" class="active">Admissions</a></li>
                <li><a href="#requirements">Requirements</a></li>
                <li><a href="#howtoapply">How to Apply</a></li>
                <li><a href="#courses">Courses</a></li>
                <li><a href="#curriculum">Curriculum</a></li>
                <li><a href="#calendar">Calendar</a></li>
                <li><a href="#apply">Apply Online</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <!-- Admissions Section -->
        <section id="admissions" class="section">
            <h2>Admissions</h2>
            <div class="subsection">
                <h3>Admission Levels</h3>
                <ul>
                    <li>Nursery Admissions</li>
                    <li>Primary Admissions</li>
                    <li>Secondary Admissions</li>
                </ul>
            </div>
            <div class="apply-info">
                <strong>Application Period:</strong> <span id="appPeriod"></span><br>
                <span id="appStatus"></span>
            </div>
        </section>

        <!-- Requirements Section -->
        <section id="requirements" class="section">
            <h2>Sample Requirements</h2>
            <div class="requirements-list">
                <div class="requirements-card">
                    <h4>Nursery</h4>
                    <ul>
                        <li>Birth Certificate (copy)</li>
                        <li>2 Passport Photos</li>
                        <li>Medical Report</li>
                        <li>Parent/Guardian ID (copy)</li>
                    </ul>
                </div>
                <div class="requirements-card">
                    <h4>Primary</h4>
                    <ul>
                        <li>Previous School Report</li>
                        <li>Birth Certificate (copy)</li>
                        <li>2 Passport Photos</li>
                        <li>Medical Report</li>
                    </ul>
                </div>
                <div class="requirements-card">
                    <h4>Secondary</h4>
                    <ul>
                        <li>Primary Leaving Certificate</li>
                        <li>Birth Certificate (copy)</li>
                        <li>2 Passport Photos</li>
                        <li>Medical Report</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- How to Apply Section -->
        <section id="howtoapply" class="section">
            <h2>How to Apply</h2>
            <ol>
                <li>Check the application period above.</li>
                <li>Prepare all required documents for your level.</li>
                <li>Fill out the <a href="#apply">online application form</a> below during the application period.</li>
                <li>Upload scanned copies of your documents.</li>
                <li>Wait for confirmation via email or phone.</li>
            </ol>
        </section>
        <!-- Courses Section -->
        <section id="courses" class="section">
            <h2>Courses/Programs Offered</h2>
            <div class="courses-grid">
                <div class="course-card">
                    <h3>Nursery</h3>
                    <ul>
                        <li>Early Childhood Education</li>
                        <li>Basic Numeracy & Literacy</li>
                        <li>Play-based Learning</li>
                    </ul>
                    <a class="download-link" href="docs/nursery-curriculum.pdf" download>Download Nursery Curriculum</a>
                </div>
                <div class="course-card">
                    <h3>Primary</h3>
                    <ul>
                        <li>Mathematics</li>
                        <li>English</li>
                        <li>Kinyarwanda</li>
                        <li>Science</li>
                        <li>Social Studies</li>
                        <li>ICT</li>
                    </ul>
                    <a class="download-link" href="docs/primary-curriculum.pdf" download>Download Primary Curriculum</a>
                </div>
                <div class="course-card">
                    <h3>Lower Secondary</h3>
                    <ul>
                        <li>Mathematics</li>
                        <li>Sciences (Biology, Chemistry, Physics)</li>
                        <li>Languages(English, Kinyarwanda)</li>
                        <li>ICT</li>
                        <li>History</li>
                        <li>Geography</li>
                        <li>Entrepreneurship</li>

                    </ul>
                    <a class="download-link" href="docs/secondary-curriculum.pdf" download>Download Secondary Curriculum</a>
                </div>
                <div class="course-card">
                    <h3>Upper Secondary</h3>
                    <ul>
                        <li>COmb 1</li>
                        <li>Comb 2</li>
                        <li>COmb 1</li>
                        <li>Comb 2</li>
                        
                    </ul>
                    <a class="download-link" href="docs/secondary-curriculum.pdf" download>Download Secondary Curriculum</a>
                </div>
            </div>
        </section>

        <!-- Curriculum Section -->
        <section id="curriculum" class="section">
            <h2>Curriculum Outlines</h2>
            <div class="accordion">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Nursery Curriculum</h3>
                        <span>▼</span>
                    </div>
                    <div class="accordion-content">
                        <ul>
                            <li>Language Development</li>
                            <li>Numeracy Skills</li>
                            <li>Physical & Social Development</li>
                            <li>Creative Arts</li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Primary Curriculum</h3>
                        <span>▼</span>
                    </div>
                    <div class="accordion-content">
                        <ul>
                            <li>Mathematics</li>
                            <li>English & Kinyarwanda</li>
                            <li>Science & Social Studies</li>
                            <li>ICT</li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Secondary Curriculum</h3>
                        <span>▼</span>
                    </div>
                    <div class="accordion-content">
                        <ul>
                            <li>Mathematics</li>
                            <li>Sciences (Biology, Chemistry, Physics)</li>
                            <li>Languages</li>
                            <li>ICT & Entrepreneurship</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Calendar Section -->
        <section id="calendar" class="section">
            <h2>Academic Calendar</h2>
            <table class="calendar-table">
                <thead>
                    <tr>
                        <th>Term</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Events</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Term 1</td>
                        <td>2025-01-15</td>
                        <td>2025-04-10</td>
                        <td>Opening Ceremony, Midterm Exams</td>
                    </tr>
                    <tr>
                        <td>Term 2</td>
                        <td>2025-05-05</td>
                        <td>2025-07-30</td>
                        <td>Sports Day, Science Fair</td>
                    </tr>
                    <tr>
                        <td>Term 3</td>
                        <td>2025-09-01</td>
                        <td>2025-11-20</td>
                        <td>Final Exams, Graduation</td>
                    </tr>
                </tbody>
            </table>
            <a class="download-link" href="docs/academic-calendar-2025.pdf" download>Download Full Calendar (PDF)</a>
        </section>

        <!-- Apply Online Section -->
        <section id="apply" class="section" style="display:none;">
            <h2>Apply Online</h2>
            <form class="apply-form" id="applyForm" enctype="multipart/form-data" method="post" action="submit-application.php">
                <label for="fullname">Full Name *</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone *</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="level">Applying for *</label>
                <select id="level" name="level" required>
                    <option value="">Select Level</option>
                    <option value="Nursery">Nursery</option>
                    <option value="Primary">Primary</option>
                    <option value="Secondary">Secondary</option>
                </select>
                <label for="documents">Upload Documents (PDF, JPG, PNG, ZIP) *</label>
                <input type="file" id="documents" name="documents[]" multiple required accept=".pdf,.jpg,.jpeg,.png,.zip">
                <label for="message">Message (optional)</label>
                <textarea id="message" name="message" rows="3"></textarea>
                <button type="submit">Submit Application</button>
            </form>
        </section>
    </div>
    <script>
        // Responsive nav menu
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('open');
        });

        // Accordion functionality
        document.querySelectorAll('.accordion-header').forEach(button => {
            button.addEventListener('click', () => {
                const item = button.parentElement;
                item.classList.toggle('active');
                const content = button.nextElementSibling;
                if (item.classList.contains('active')) {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none';
                }
            });
        });
        // Initialize accordion closed
        document.querySelectorAll('.accordion-content').forEach(c => c.style.display = 'none');

        // Smooth scroll for navigation
        document.querySelectorAll('.nav-links a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const yOffset = 70; // adjust if you have a fixed header
                    const y = target.getBoundingClientRect().top + window.pageYOffset - yOffset;
                    window.scrollTo({ top: y, behavior: 'smooth' });
                }
                // Close menu on mobile after click
                if (window.innerWidth < 700) navLinks.classList.remove('open');
            });
        });

        // Application period logic
        // Set your application period here:
        const appStart = new Date('2025-04-01');
        const appEnd = new Date('2025-05-31');
        const now = new Date();
        document.getElementById('appPeriod').textContent =
            appStart.toLocaleDateString() + " to " + appEnd.toLocaleDateString();
        if (now >= appStart && now <= appEnd) {
            document.getElementById('appStatus').innerHTML = "<span style='color:green;font-weight:bold;'>Applications are OPEN!</span>";
            document.getElementById('apply').style.display = "block";
        } else {
            document.getElementById('appStatus').innerHTML = "<span style='color:red;font-weight:bold;'>Applications are CLOSED.</span>";
            document.getElementById('apply').style.display = "none";
        }
    </script>
</body>
</html>