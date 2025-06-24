 <?php
// if (!defined('BASE_PATH')) {
//     die('Direct access not allowed');
// }
?>
 <style>
   .footer {
     /* position: sticky; */
     background-color: #1a5276;
     color: white;
     padding: 40px 0 20px;
     /* width: 100%;
      bottom: 0; */
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
     padding-left: 0;
     /* Override the general link hover effect */
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

   /* suscription popup */
   .subscription-popup {
    border-radius: 10px;
    color: black;
     align-content: center;
     text-align: center;
     display: none;
     position: fixed;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
     width: 30%;
     height: 30%;
     /* background-color: rgba(62, 86, 81, 0.7); */
     background-color:  aquamarine;
     justify-content: center;
     align-items: center;

   }

   .subscription-popup h3 { 
     font-size: 1.5rem;
     margin-bottom: 10px;
     text-align: center;
   }

   .subscription-popup button {
    color: white;
     position: absolute;
     bottom: 0;
     background-color:rgb(23, 67, 96);
     color: white;
     border: none;
     padding: 10px 15px;
     border-radius: 4px;
     cursor: pointer;
     left: 30%;
     width: 50%;
     bottom: 10px;
     transition: all 0.3s ease;
   }
 </style>

 <footer class="footer" id="footer">
   <div class="footer-container">
     <div class="footer-section">
       <h3>About School</h3>
       <p>We are a model school dedicated to excellence, nurturing students through innovative, student-centered teaching. Our mission is to equip every learner with critical thinking, problem-solving, and leadership skills, ensuring 100% graduation and high national exam success preparing confident, capable, and compassionate leaders for tomorrow's changing world.</p>
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
         <li><a href="/RMS-Project/">Home</a></li>
         <li><a href="/RMS-Project/pages/about">About Us</a></li>
         <li><a href="/RMS-Project/pages/academics">Academics</a></li> 
          <li><a href="/RMS-Project/pages/academics#requirements">Admissions</a></li>
          <li><a href="/RMS-Project/pages/academics#courses">Courses/Programs Offered</a></li>
          <li><a href="/RMS-Project/pages/academics#curriculum">Curriculum Outlines</a></li>
          <li><a href="/RMS-Project/pages/academics#calendar">Academic Calendar</a></li>
         <li><a href="/RMS-Project/login">Student Portal</a></li> 
         <li><a href="index" data-scroll-to="footer">Contact</a></li>
       </ul>
     </div>

     <div class="footer-section">
       <h3>Contact Info</h3>
       <div class="contact-info">
         <i class="fas fa-map-marker-alt"></i>
         <span>Kayonza, Gahini</span>
       </div>
       <div class="contact-info">
         <i class="fas fa-phone-alt"></i>
         <span>0788244491 / 079245452</span>
       </div>
       <div class="contact-info">
         <i class="fas fa-envelope"></i>
         <span>modelrukara@gmail.com</span>
       </div>
       <div class="contact-info">
         <i class="fas fa-clock"></i>
         <span>Monday-Friday: 8:00 AM - 4:00 PM</span>
       </div>
     </div>
     <!-- 
     Principal,Dean of studies(Nursery and primary and secondary), bursar,secretary
      -->
     <div class="footer-section">
       <h3>Newsletter</h3>
       <p>Subscribe to our newsletter to receive updates about school events, news, and important announcements.</p>
       <form class="subscribe-form">
         <input type="email" id="sub-email" placeholder="Enter your email" required>
         <button id="subscribeButton" type="submit"><i class="fas fa-paper-plane"></i></button>
       </form>
     </div>
     <div class="subscription-popup">
       <div class="popup-content" id="thanksPopup">
         <h3>Thank You!</h3>
         <p>You have successfully subscribed to our newsletter.</p>
         <button onclick="closePopup()" id="closePopup">Close</button>
       </div>
     </div>
   </div>

   <div class="copyright">
     <p>&copy; <span id="year"></span> Rukara Model School. All Rights Reserved.</p>
   </div>
 </footer>
 <script>
  emailInput = document.getElementById('sub-email');
     // JavaScript for the subscription popup
     document.getElementById('subscribeButton').addEventListener('click', function(e) {
     e.preventDefault();
  if(emailInput.value == "" || emailInput.value == null){
      // Show an alert if the email input is empty
    alert("Please enter your email address.");
  }else{ 
     document.querySelector('.subscription-popup').style.display = 'block'; 
     //prevent scroll when popup in active
      document.body.style.overflow = 'hidden';
  }
   });
  
  // Function to close the popup
  
  function closePopup() { 
    document.querySelector('.subscription-popup').style.display= 'none';
    document.body.style.overflow = 'auto';

   }

   document.getElementById('year').textContent = new Date().getFullYear(); 
    
 </script>