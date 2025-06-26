 <?php
define('SECURE_ACCESS', true);
require_once '../config/security.php';
?> 
 <?php include("../includes/db.php");?>
 <?php
        
// Get event name from URL
if (isset($_GET['event_name'])) {
    $event_name = $_GET['event_name']; // Do NOT use intval here — it's a string

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM events WHERE event_name = ? ");
    $stmt->bind_param("s", $event_name); // 's' for string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 0) {
        $event = $result->fetch_assoc();
        // You can now access $event['event_type'], $event['event_date'], etc.
    } else {
        echo "Event not found.";
    }
}?>
 <?php
$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);
?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>RMS | News</title> 
         <?php secure_include('header-links.php'); ?> 
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
     <link rel="stylesheet"
         href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
     <style>
         /* @import url("assets/css/nav.css"); */
         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
             font-family: Arial, sans-serif;
         }

         body {
             background-color: #f5f5f5;
         }

         .container {
             max-width: 1200px;
             margin: 0 auto;
             padding: 20px;
             height: fit-content;
         }

         /* Search Bar */
         .search-container {
             margin: 20px 0;
             width: 100%;
             display: flex;
             justify-content: flex-end;
             margin-top: 50px;
         }

         .search-bar {
             display: flex;
             max-width: 400px;
             width: 100%;
         }

         .search-input {
             flex-grow: 1;
             padding: 10px 15px;
             border: 1px solid #ddd;
             border-radius: 4px 0 0 4px;
             font-size: 16px;
         }

         .search-button {
             padding: 10px 20px;
             background-color: #10b981;
             color: white;
             border-radius: 0 4px 4px 0;
             cursor: pointer;
             font-size: 16px;
         }

         /* News Layout */
         .news-container {
             display: flex;
             flex-wrap: wrap;
             gap: 20px;
             /* height: calc(100vh - 150px); */
             /* Adjust based on your header/search bar height */
         }

         .main-news {
             flex: 1;
             min-width: 300px;
             overflow-y: auto;
             max-height: fit-content;
             padding-right: 10px;
             z-index: -1;
         }

         .sidebar-news {
             border-left: 1px solid #ddd;
             padding-left: 20px;
             width: 350px;
             overflow-y: auto;
             max-height: 100%;
             padding-right: 10px;
         }

         /* Scrollbar styling */
         .main-news::-webkit-scrollbar,
         .sidebar-news::-webkit-scrollbar {
             width: 8px;
         }

         .main-news::-webkit-scrollbar-track,
         .sidebar-news::-webkit-scrollbar-track {
             background: #f1f1f1;
             border-radius: 10px;
         }

         .main-news::-webkit-scrollbar-thumb,
         .sidebar-news::-webkit-scrollbar-thumb {
             background: #10b981;
             border-radius: 10px;
         }



         /* Section Titles */
         .section-title {
             color: #10b981;
             font-size: 28px;
             margin-bottom: 20px;
             padding-bottom: 10px;
             border-bottom: 2px solid #10b981;
         }

         /* News Article */
         .news-article {
             background-color: white;
             border-radius: 8px;
             overflow-y: none;
             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
             margin-bottom: 20px;
         }

         .news-image {
             width: 100%;
             height: auto;
             object-fit: cover;
         }

         .news-content {
             padding: 15px;
         }

         .news-title {
             color: #0891b2;
             font-size: 24px;
             margin-bottom: 10px;
         }

         .news-excerpt {
             color: #333;
             margin-bottom: 15px;
             line-height: 1.5;
         }

         .full-content {
             display: none;
             color: #333;
             margin: 15px 0;
             line-height: 1.5;
         }

         .news-meta {
             color: #666;
             font-size: 14px;
             text-align: right;
             font-style: italic;
         }

         .read-more {
             display: inline-block;
             background-color: #10b981;
             color: white;
             padding: 8px 16px;
             border-radius: 4px;
             text-decoration: none;
             margin-top: 10px;
             cursor: pointer;
         }

         /* Advertisement Section */
         .ad-card {
             background-color: white;
             border-radius: 8px;
             overflow: hidden;
             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
             margin-bottom: 20px;
         }

         .ad-image {
             width: 100%;
             height: auto;
         }

         .ad-content {
             padding: 15px;
             text-align: center;
         }

         .ad-text {
             font-size: 16px;
             line-height: 1.5;
             color: #333;
         }

         /* Highlight Results */
         .highlight {
             background-color: green;
             font-weight: bold;
         }

         /* No Results Message */
         .no-results {
             padding: 20px;
             text-align: center;
             background-color: #f8d7da;
             color: #721c24;
             border-radius: 8px;
             margin: 20px 0;
             display: none;
         }

         .top-bar {
             background-color: #10b981;
             color: white;
             padding: 10px 20px;
             text-align: center;
             font-size: 18px;
             font-weight: bold;
             position: fixed;
             width: 100%;
             cursor: pointer;
             margin-bottom: 20px
         }

         .top-bar:hover {
             background-color: rgb(43, 94, 77);
         }

         .full-content {
             display: none;
             margin: 15px 0;
             line-height: 1.6;
         }

         .news-excerpt {
             display: block;
             margin-bottom: 15px;
         }

         @media (max-width: 768px) {

             .news-container {
                 flex-direction: column;
                 height: auto;
             }

             .main-news,
             .sidebar-news {

                 width: 100%;
                 height: auto;
                 /* max-height: 60vh; */
                 margin-bottom: 20px;
                 overflow-y: none;
             }
         }
     </style>
 </head>

 <body  >
     <!--

<br /><b>Warning</b>:  Undefined variable $event in <b>C:\xampp\htdocs\RMS-Project\pages\news.php</b> on line <b>300</b><br /><br /><b>Warning</b>:  Trying to access array offset on value of type null in <b>C:\xampp\htdocs\RMS-Project\pages\news.php</b> on line <b>300</b><br />
    -->
     <?php 
//    include("includes/navigation.php");
   ?>
     <?php include("../includes/progress-bar.php"); ?>

     <div onclick="goBack()" class="top-bar">Go back</div>
     <div class="container">
         <!-- Search Bar -->
         <div class="search-container">
             <div class="search-bar">
                 <input type="text" onchange="performSearch()"  value="<?php echo $event['event_name'] ?? ''; ?>"
 class="search-input" id="searchInput"
                     placeholder="Search news...">
                 <button class="search-button"  id="searchButton">Search</button>
             </div>
         </div>

         <!-- No Results Message -->
         <div class="no-results" id="noResults">
             No results found for your search.
         </div>

         <!-- News Content -->
         <div class="news-container">
             <!-- Main News Section -->
             <div class="main-news">
                 <h2 class="section-title">Latest News</h2>

                 <!-- News Article 1 -->
                 <div class="news-article">
                     <img src="https://tse3.mm.bing.net/th?id=OIP.U_VJuupQohwnzXcKMztqWgHaEo&pid=Api&P=0&h=220"
                         alt="Students at computers" class="news-image">
                     <div class="news-content">
                         <h3 class="news-title">Research Visit to Our Students</h3>
                         <p class="news-excerpt">We had the privilege of welcoming visitors who came to assess the
                             progress of our students in their computer literacy program. The researchers were impressed
                             by the skills our students have developed over the past semester.</p>
                         <div class="full-content">
                             <p>During their two-day visit, the research team observed classroom activities, conducted
                                 interviews with students and teachers, and reviewed project portfolios. They noted
                                 significant improvements in both technical abilities and problem-solving skills among
                                 our student body.</p>
                             <p>The visitors particularly praised our innovative teaching methods and the integration of
                                 practical applications into the curriculum. Several students received special
                                 recognition for their outstanding projects, which demonstrated exceptional creativity
                                 and technical proficiency.</p>
                             <p>This positive feedback validates our educational approach and motivates us to continue
                                 enhancing our programs. We extend our gratitude to the research team for their valuable
                                 insights and to our dedicated teachers who have been instrumental in guiding our
                                 students toward success.</p>
                         </div>
                         <div id="show-full-content"></div>
                         <button class="read-more" id="toggle-full-content">Read More</button>
                         <p class="news-meta">Published on: 2025-02-05 10:59:17</p>
                     </div>
                 </div>
             </div>

             <!-- Sidebar - Advertisements & News -->
             <div class="sidebar-news">
                 <h2 class="section-title">Upcoming Events</h2>
                 <!-- Ad 1 -->
                 <!-- <div class="ad-card">
                     <img src="https://tse2.mm.bing.net/th?id=OIP.oLFLTdgyYd3ILOdDdTux2gHaHa&pid=Api&P=0&h=220"
                         alt="School Dashboard" class="ad-image">
                     <div class="ad-content">
                         <p class="ad-text">Empower your team with School's intuitive dashboard—efficient,
                             customizable, and secure for all roles!</p>
                     </div>
                 </div> -->
                 <!-- Ad 2 -->
                 <!-- <div class="ad-card">
                     <img src="https://tse2.mm.bing.net/th?id=OIP.oLFLTdgyYd3ILOdDdTux2gHaHa&pid=Api&P=0&h=220"
                         alt="Summer program" class="ad-image">
                     <div class="ad-content">
                         <p class="ad-text">Join our summer coding bootcamp! Learn the skills that will prepare you for
                             the future of technology.</p>
                     </div>
                 </div> -->

                 <?php
if ($result->num_rows > 0):?>
                 <?php while($row = $result->fetch_assoc()):?>
                    <?php
                    if($row["mark"]!=null||$row["event_date"] < date("Y-m-d") || ($row["event_date"] == date("Y-m-d") && $row["event_time"] < date("H:i:s"))) {
                        continue; // Skip past events
                    }
                        ?> 
                 <!-- Small News Item -->
                 <div class="news-article">
    <div class="news-content">
        <h3 class="news-title"><?php echo $row["event_name"]; ?></h3>

        <div class="event-meta"
             data-event-date="<?php echo $row["event_date"]; ?>" 
             data-event-time="<?php echo $row["event_time"]; ?>">
            <p class="event-date-time">
                <strong>Date:</strong> <?php echo $row["event_date"]; ?> at <?php echo $row["event_time"]; ?>
            </p>
            <p><strong>Type:</strong> <?php echo $row["event_type"]; ?></p>
            <p><strong>Location:</strong> <?php echo $row["event_location"]; ?></p>
        </div>

        <div class="full-content">
            <p><?php echo $row["event_description"]; ?></p>
        </div>

        <button class="read-more">Read More</button>
    </div>
</div>

                 <?php
                            endwhile; 
                        endif;
                            ?>
             </div>
         </div>
     </div>

    <?php secure_include('../includes/footer.php'); ?>  
    <?php secure_include('../includes/back-to-top.php'); ?>
   
<script>
document.addEventListener("DOMContentLoaded", function () {
    const articles = document.querySelectorAll(".news-article");

    articles.forEach(article => {
        const meta = article.querySelector(".event-meta");
        const dateStr = meta.getAttribute("data-event-date"); // e.g. 2025-06-20
        const timeStr = meta.getAttribute("data-event-time"); // e.g. 16:18:00

        const eventDateTime = new Date(`${dateStr}T${timeStr}`);
        const now = new Date();

        const dateTimeDisplay = meta.querySelector(".event-date-time");
        const readMoreBtn = article.querySelector(".read-more");

        const isSameDay = now.toISOString().split('T')[0] === dateStr;

        if (now >= eventDateTime && isSameDay) {
            // Event is happening now
            dateTimeDisplay.innerHTML = `<strong>Happening Now</strong>`;
        } else if (now > eventDateTime && !isSameDay) {
            // Event has passed
            if (dateTimeDisplay) dateTimeDisplay.style.display = "none";
            if (readMoreBtn) {
                readMoreBtn.disabled = true;
                readMoreBtn.style.opacity = 0.5;
                readMoreBtn.style.cursor = "not-allowed";
            }
        }
    });
});
</script>

     <script> 
         //full content popup page
         document.getElementById('toggle-full-content').addEventListener('click', function() {
             document.getElementById('show-full-content').style.display = 'block';
             fullcontent.innerHTML = `
                    <p>hello there</p>
                `;
         });
         document.addEventListener('DOMContentLoaded', function() {
             const searchInput = document.getElementById('searchInput');
             const searchButton = document.getElementById('searchButton');
             const noResults = document.getElementById('noResults');
             const readMoreButtons = document.querySelectorAll('.read-more');
             // Add Read More functionality
             readMoreButtons.forEach(button => {
                 button.addEventListener('click', function() {
                     const content = this.previousElementSibling;
                     const excerpt = content.previousElementSibling;
                     if (content.style.display === 'block') {
                         // Collapse
                         content.style.display = 'none';
                         this.textContent = 'Read More';
                         // Scroll back to title
                         const title = excerpt.previousElementSibling;
                         title.scrollIntoView({
                             behavior: 'smooth'
                         });
                     } else {
                         // Expand
                         content.style.display = 'block';
                         this.textContent = 'Read Less';
                     }
                 });
             });
             // Search function
             function performSearch() {
                 const searchTerm = searchInput.value.toLowerCase().trim();
                 if (searchTerm === '') {
                     resetSearch();
                     return;
                 }
                 const contentElements = document.querySelectorAll(
                     '.news-title, .news-excerpt, .full-content, .ad-text');
                 let foundResults = false;
                 // Reset previous search
                 resetSearch();
                 // Search through all content
                 contentElements.forEach(element => {
                     const content = element.innerHTML;
                     if (content.toLowerCase().includes(searchTerm)) {
                         foundResults = true;
                         // Highlight the matching text
                         const regex = new RegExp(searchTerm, 'gi');
                         const highlightedText = content.replace(regex, match =>
                             `<span class="highlight">${match}</span>`);
                         element.innerHTML = highlightedText;
                         // Make sure the parent article is visible
                         let parentArticle = element.closest('.news-article, .ad-card');
                         if (parentArticle) {
                             parentArticle.style.display = 'block';
                             // If match is in full content, expand it
                             if (element.classList.contains('full-content')) {
                                 element.style.display = 'block';
                                 const readMoreBtn = element.nextElementSibling;
                                 if (readMoreBtn && readMoreBtn.classList.contains('read-more')) {
                                     readMoreBtn.textContent = 'Read Less';
                                 }
                             }
                         }
                     } else {
                         // Check if no other searchable element in this article contains the search term
                         let parentArticle = element.closest('.news-article, .ad-card');
                         if (parentArticle) {
                             const otherElements = parentArticle.querySelectorAll(
                                 '.news-title, .news-excerpt, .full-content, .ad-text');
                             let articleHasMatch = false;
                             otherElements.forEach(otherElement => {
                                 if (otherElement !== element &&
                                     otherElement.innerHTML.toLowerCase().includes(searchTerm)
                                 ) {
                                     articleHasMatch = true;
                                 }
                             });
                             if (!articleHasMatch) {
                                 parentArticle.style.display = 'none';
                             }
                         }
                     }
                 });
                 // Show "no results" message if needed
                 if (!foundResults) {
                     noResults.style.display = 'block';
                     // document.getElementsByClassName("section-title")[0].style.display = "none";
                     // document.getElementsByClassName("section-title")[1].style.display = "none";
                     document.querySelectorAll(".section-title").forEach(element => {
                         element.style.display = "none";
                     })
                 } else {
                     document.querySelectorAll(".section-title").forEach(element => {
                         element.style.display = "block";
                     })
                 }
             }
             // Reset search results
             function resetSearch() {
                 const contentElements = document.querySelectorAll(
                     '.news-title, .news-excerpt, .full-content, .ad-text');
                 contentElements.forEach(element => {
                     // Remove highlights
                     element.innerHTML = element.innerHTML.replace(
                         /<span class="highlight">(.+?)<\/span>/g, '$1');
                     // Make sure all articles are visible
                     let parentArticle = element.closest('.news-article, .ad-card');
                     if (parentArticle) {
                         parentArticle.style.display = 'block';
                     }
                     // Collapse full content unless specifically expanded
                     if (element.classList.contains('full-content') &&
                         !element.innerHTML.includes('class="highlight"')) {
                         element.style.display = 'none';
                         const readMoreBtn = element.nextElementSibling;
                         if (readMoreBtn && readMoreBtn.classList.contains('read-more')) {
                             readMoreBtn.textContent = 'Read More';
                         }
                     }
                 });
                 // Hide "no results" message
                 noResults.style.display = 'none';
             }
             // Event listeners
             searchButton.addEventListener('click', performSearch);
             document.addEventListener('DomContentLoaded', performSearch);

             searchInput.addEventListener('keypress', function(e) {
                 if (e.key === 'Enter') {
                     performSearch();
                 }
             });

             // Clear search when input is cleared
             searchInput.addEventListener('input', function() {
                 if (this.value === '') {
                     resetSearch();
                 }
             });
         });
     </script>
     <script>
         function goBack() {
             window.history.back();
         }
     </script>
     <!-- <script src="assets/js/nav.js"></script> -->
 </body>

 </html>