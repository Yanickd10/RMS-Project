 
  <style> 
    .footer {
      background-color: #1a5276;
      color: white;
      padding: 40px 0 20px;
    }
    
    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 15px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
    }
    
    .footer-section h3 {
      font-size: 1.2rem;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .footer-section h3::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 50px;
      height: 2px;
      background-color: #3498db;
    }
    
    .footer-section p {
      margin-bottom: 10px;
      font-size: 0.9rem;
      line-height: 1.6;
    }
    
    .footer-section ul {
      list-style: none;
    }
    
    .footer-section ul li {
      margin-bottom: 8px;
    }
    
    .footer-section a {
      color: #ccc;
      text-decoration: none;
      transition: all 0.3s ease;
      font-size: 0.9rem;
    }
    
    .footer-section a:hover {
      color: #3498db;
      padding-left: 5px;
    }
    
    .contact-info {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .contact-info i {
      width: 30px;
      height: 30px;
      background-color: #2c3e50;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
      font-size: 14px;
    }
    
    .social-links {
      display: flex;
      margin-top: 20px;
    }
    
    .social-links a {
      width: 35px;
      height: 35px;
      background-color: #2c3e50;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
      transition: all 0.3s ease;
    }
    
    .social-links a:hover {
      background-color: #3498db;
      transform: translateY(-3px);
      padding-left: 0; /* Override the general link hover effect */
    }
    
    .social-links a i {
      font-size: 16px;
      color: white;
    }
    
    .subscribe-form {
      display: flex;
      margin-top: 15px;
    }
    
    .subscribe-form input {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 4px 0 0 4px;
      outline: none;
      font-size: 0.9rem;
    }
    
    .subscribe-form button {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 0 4px 4px 0;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .subscribe-form button:hover {
      background-color: #2980b9;
    }
    
    .copyright {
      text-align: center;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      font-size: 0.9rem;
    }
    
    @media screen and (max-width: 992px) {
      .footer-container {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    
    @media screen and (max-width: 576px) {
      .footer-container {
        grid-template-columns: 1fr;
      }
    }
  </style>  

  <footer class="footer" id="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h3>About School</h3>
        <p>Our school is dedicated to providing high-quality education and fostering a supportive environment for students to grow academically and personally.</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
      
      <div class="footer-section">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="academics.html">Academics</a></li>
          <li><a href="admissions.html">Admissions</a></li>
          <li><a href="student-portal.html">Student Portal</a></li>
          <li><a href="staff-portal.html">Staff Portal</a></li>
          <li><a href="contact.html">Contact Us</a></li>
        </ul>
      </div>
      
      <div class="footer-section">
        <h3>Contact Info</h3>
        <div class="contact-info">
          <i class="fas fa-map-marker-alt"></i>
          <span>123 Education Street, School City, 12345</span>
        </div>
        <div class="contact-info">
          <i class="fas fa-phone-alt"></i>
          <span>+1 (555) 123-4567</span>
        </div>
        <div class="contact-info">
          <i class="fas fa-envelope"></i>
          <span>info@schoolname.edu</span>
        </div>
        <div class="contact-info">
          <i class="fas fa-clock"></i>
          <span>Monday-Friday: 8:00 AM - 4:00 PM</span>
        </div>
      </div>
      
      <div class="footer-section">
        <h3>Newsletter</h3>
        <p>Subscribe to our newsletter to receive updates about school events, news, and important announcements.</p>
        <form class="subscribe-form">
          <input type="email" placeholder="Enter your email" required>
          <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
      </div>
    </div>
    
    <div class="copyright">
      <p>&copy; 2025 School Name. All Rights Reserved.</p>
    </div>
  </footer> 