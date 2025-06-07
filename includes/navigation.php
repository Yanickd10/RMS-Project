<style>
   
   * {
      margin: 0;
      padding: 0;

      box-sizing: border-box;
       font-family: 'Times New Roman', Times, serif;
    }
    
    body {
      background-color: #f5f7fa;
    }
    
    .navbar {
    
      background-color: #1a5276;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 100;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 70px;
    }
    
    .logo {
      display: flex;
      align-items: center;
    }
    
    .logo img {
      border-radius: 50%;
      height: 50px;
      margin-right: 10px;
    }
    
    .logo h1 {
      color: white;
      font-size: 1.5rem;
      font-weight: 600;
    }
    
    .nav-links {
      display: flex;
      list-style: none;
    }
    
    .nav-links li {
      position: relative;
    }
    
    .nav-links a {
      display: block;
      padding: 25px 15px;
      color: white;
      text-decoration: none;
      font-size: 1rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .nav-links a:hover {
      background-color: #2980b9;
    }
    
    .dropdown {
      position: absolute;
      top: 100%;
      left: 0;
      width: 230px;
      background-color:  #1a5276;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
      display: block;
      transition: all 0.3s ease;
      z-index: 200;
    }
       
    
    .nav-links li:hover .dropdown {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
     
    
    .dropdown a {
      padding: 12px 15px;
      font-size: 0.9rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .dropdown a:hover {
      background-color:rgb(48, 97, 127);
    }
    
    .has-dropdown::after {
      content: '▼';
      font-size: 0.7rem;
      margin-left: 5px;
    }
    
    .mobile-menu-btn {
      display: none;
      cursor: pointer;
      color: white;
      font-size: 1.5rem;
    }

    .active {
      background-color: #2980b9;
    }
    
    .portal-buttons {
      display: flex;
      gap: 10px;
    }
    
    .portal-btn {
      background-color: #e74c3c;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .portal-btn:hover {
      background-color: #c0392b;
    }
    
    .student-portal {
      background-color: #3498db;
    }
    
    .student-portal:hover {
      background-color: #2980b9;
    }
    
    @media screen and (max-width: 992px) {
      .nav-links {
        position: absolute;
        top: 70px;
        left: 0;
        background-color: #1a5276;
        width: 100%;
        height: 100vh;
        overflow-y: auto;
        flex-direction: column;
        display: none;
      }
      
      .nav-links.show {
        display: flex;
      }
      
      .dropdown {
        position: static;
        width: 100%;
        box-shadow: none;
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        display: none;
        background-color: #34495e;
      }
     
      
      .dropdown.show {
        display: block;
      }
      
      .mobile-menu-btn {
        display: block;
      }
      
      .portal-buttons {
        margin-left: auto;
      }
      
      .has-dropdown {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      
      .has-dropdown::after {
        content: '+';
        margin-left: 10px;
        font-size: 1.2rem;
      }
      
      .has-dropdown.active::after {
        content: '+';
      }
    }
    
    @media screen and (max-width: 576px) {
      .container {
        height: 60px;
      }
      
      .logo h1 {
        font-size: 1.2rem;
      }
      
      .nav-links {
        top: 60px;
      }
      
      .portal-buttons {
        display: none;
      }
      
      .portal-links {
        display: flex;
        flex-direction: column;
      }
      
      .portal-links a {
        padding: 15px;
        color: white;
        text-decoration: none;
        background-color: #3498db;
        margin: 5px 15px;
        text-align: center;
        border-radius: 5px;
      }
      
      .portal-links a:last-child {
        background-color: #e74c3c;
      }
    }
</style>
<?php 
include("progress-bar.php");
?>
<nav class="navbar">
  <div class="container">
    <div class="logo">
      <a href="/RMS-Project/"><img id="logoImg" style=" border-radius: 50%;"></a>
      <h1>Rukara Model School</h1>
    </div>
    <div class="mobile-menu-btn" onclick="toggleMenu()">
      ☰
    </div>
    <ul class="nav-links" id="navLinks">
      <li>
        <a href="/RMS-Project/" class="has-dropdown active">Home</a>
        <ul class="dropdown"> 
          <li><a href="/RMS-Project/index.php#mission">Mission and Core Values</a></li>
          <li><a href="/RMS-Project/index.php#goals">Strategic Goals</a></li>
          <li  style="display: none;"><a href="/RMS-Project/index.php#community">Community Engagement</a></li>
          <li style="display: none;"><a href="/RMS-Project/index.php#activities"  >Extracurricular Activities</a></li>
          <li><a href="/RMS-Project/index.php#news">News & Announcements</a></li> 
        </ul>
      </li>
      <li>
        <a href="/RMS-Project/pages/about" class="has-dropdown">About Us</a>
        <ul class="dropdown">
          <li><a href="/RMS-Project/pages/about.php#history">School History</a></li> 
          <li><a href="/RMS-Project/pages/about.php#staff">Staff Profiles</a></li>
        </ul>
      </li>
      <li>
        <a href="/RMS-Project/pages/academics" class="has-dropdown">Academics</a>
        <ul class="dropdown">
          <li><a href="/RMS-Project/pages/academics#requirements">Admissions</a></li>
          <li><a href="/RMS-Project/pages/academics#courses">Courses/Programs Offered</a></li>
          <li><a href="/RMS-Project/pages/academics#curriculum">Curriculum Outlines</a></li>
          <li><a href="/RMS-Project/pages/academics#calendar">Academic Calendar</a></li>
        </ul>
      </li>
      <li>
        <a class="/RMS-Project/login">Portals</a>
        <ul class="dropdown">
          <li><a href="/RMS-Project/login">Adminstration</a></li>
          <li><a href="">Teacher Portal</a></li>
          <li><a href="/RMS-Project/login">Student Portal</a></li> 
        </ul>
      </li>
      <li style="display: none;">
        <a href="/RMS-Project/RMS-TEP">TEP</a>
      </li>
      <li>
        <a href="/RMS-Project/pages/news">Events</a>
      </li>
      <li>
        <a href="index" data-scroll-to="footer">Contact</a>
      </li>
    </ul> 
  </div>
</nav>