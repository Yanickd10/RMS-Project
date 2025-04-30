<nav class="navbar">
    <div class="container">
      <div class="logo">
        <img src="/api/placeholder/50/50" alt="School Logo">
        <h1>Rukara Model School</h1>
      </div>
      
      <div class="mobile-menu-btn" onclick="toggleMenu()">
        ☰
      </div>
      
      <ul class="nav-links" id="navLinks">
        <li>
          <a href="/RMS-Project/" class="has-dropdown active">Home</a>
          <ul class="dropdown">
            <li><a href="#welcome">Welcome Message</a></li>
            <li><a href="#mission">Mission and Vision</a></li>
            <li><a href="#goals">Strategic Goals</a></li>
            <li><a href="#community">Community Engagement</a></li>
            <li><a href="#extracurricular">Extracurricular Activities</a></li>
            <li><a href="#news">News & Announcements</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/about" class="has-dropdown">About Us</a>
          <ul class="dropdown">
            <li><a href="about.html#history">School History</a></li>
            <li><a href="about.html#administration">Administration Team</a></li>
            <li><a href="about.html#staff">Staff Profiles</a></li>
          </ul>
        </li>
        <li>
          <a href="academics.html" class="has-dropdown">Academics</a>
          <ul class="dropdown">
          <li><a href="admissions.html">Admissions</a></li>
            <li><a href="academics.html#courses">Courses/Programs Offered</a></li>
            <li><a href="academics.html#curriculum">Curriculum Outlines</a></li>
            <li><a href="academics.html#calendar">Academic Calendar</a></li>
          </ul>
        </li>
        
        <li>
          <a href="contact.html"  >Contact</a>
        </li>
        <li class="portal-links" style="display: none;">
          <a href="student-portal.html">Students Portal</a>
          <a href="staff-portal.html">Staff Portal</a>
        </li>
      </ul>
      
      <div class="portal-buttons">
        <button class="portal-btn student-portal" onclick="window.location.href='student-portal.html'">Students Portal</button>
        <button class="portal-btn" onclick="window.location.href='staff-portal.html'">Staff Portal</button>
      </div>
    </div>
  </nav>