<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RMS | News</title>
    
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
            z-index: -1 ;
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
            background-color:rgb(43, 94, 77); 
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

<body> 
   <?php 
//    include("includes/navigation.php");
   ?> 
<?php include("../includes/progress-bar.php"); ?>

<div onclick="goBack()" class="top-bar">Go back</div>
    <div class="container">
        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-bar">
                <input type="text" class="search-input" id="searchInput" placeholder="Search news...">
                <button class="search-button" id="searchButton">Search</button>
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

                <!-- News Article 2 -->
                <div class="news-article">
                    <img src="https://tse3.mm.bing.net/th?id=OIP.U_VJuupQohwnzXcKMztqWgHaEo&pid=Api&P=0&h=220"
                        alt="New facilities" class="news-image">
                    <div class="news-content">
                        <h3 class="news-title">New Learning Facilities Now Open</h3>
                        <p class="news-excerpt">We are excited to announce that our newly renovated learning facilities
                            are now open for all students. The modern classrooms are equipped with state-of-the-art
                            technology to enhance the learning experience.</p>
                        <div class="full-content">
                            <p>After six months of construction and renovation, our new learning facilities are finally
                                ready for use. The upgrade includes 12 reimagined classrooms, each featuring interactive
                                smart boards, collaborative workspaces, and ergonomic furniture designed to promote
                                student engagement and comfort.</p>
                            <p>The computer lab has been expanded to accommodate 30 students simultaneously, with new
                                high-performance workstations that support the latest software requirements for our
                                technical courses. Additionally, we've installed a dedicated multimedia room equipped
                                for video production, audio recording, and graphic design projects.</p>
                            <p>These improvements were made possible through generous donations from our alumni
                                association and corporate partners. An official ribbon-cutting ceremony will be held
                                next month, but students are welcome to start using the facilities immediately.</p>
                        </div>
                         <div id="show-full-content"></div>
                        <button class="read-more" id="toggle-full-content">Read More</button>
                        <p class="news-meta">Published on: 2025-01-28 14:30:22</p>
                    </div>
                </div>

                <!-- News Article 3 -->
                <div class="news-article">
                    <img src="https://tse3.mm.bing.net/th?id=OIP.U_VJuupQohwnzXcKMztqWgHaEo&pid=Api&P=0&h=220"
                        alt="Award ceremony" class="news-image">
                    <div class="news-content">
                        <h3 class="news-title">Students Win National Science Competition</h3>
                        <p class="news-excerpt">Our dedicated team of students has brought home the first prize from the
                            National Science Competition. Their innovative project on renewable energy solutions
                            impressed the judges and earned them national recognition.</p>
                        <div class="full-content">
                            <p>The winning project, titled "SolarFlow: Integrating Solar Energy in Urban Water Systems,"
                                was developed by a team of five students from our Advanced Science Program. Their
                                prototype demonstrates how solar energy can be harvested from water distribution systems
                                without disrupting the infrastructure or quality of water supply.</p>
                            <p>The competition, which featured over 200 entries from schools across the country,
                                evaluated projects based on innovation, practical application, and presentation. Our
                                students' clear explanation of complex scientific principles and their working prototype
                                gave them the edge over other competitors.</p>
                            <p>As winners, the team has been awarded a $10,000 grant to further develop their project
                                and will represent our country at the International Youth Science Forum in Geneva this
                                summer. This achievement reflects the exceptional quality of our science program and the
                                outstanding talent of our students.</p>
                        </div>
                        <div id="show-full-content"></div>
                        <button class="read-more" id="toggle-full-content">Read More</button>
                        <p class="news-meta">Published on: 2025-01-15 09:45:11</p>
                    </div>
                </div>
             
            </div>

            <!-- Sidebar - Advertisements & News -->
            <div class="sidebar-news">
                <h2 class="section-title">Advertisements & News</h2>

                <!-- Ad 1 -->
                <div class="ad-card">
                    <img src="https://tse2.mm.bing.net/th?id=OIP.oLFLTdgyYd3ILOdDdTux2gHaHa&pid=Api&P=0&h=220" alt="School Dashboard" class="ad-image">
                    <div class="ad-content">
                        <p class="ad-text">Empower your team with School's intuitive dashboard—efficient,
                            customizable, and secure for all roles!</p>
                    </div>
                </div>

                <!-- Ad 2 -->
                <div class="ad-card">
                    <img src="https://tse2.mm.bing.net/th?id=OIP.oLFLTdgyYd3ILOdDdTux2gHaHa&pid=Api&P=0&h=220" alt="Summer program" class="ad-image">
                    <div class="ad-content">
                        <p class="ad-text">Join our summer coding bootcamp! Learn the skills that will prepare you for
                            the future of technology.</p>
                    </div>
                </div>

                <!-- Small News Item -->
                <div class="news-article">
                    <div class="news-content">
                        <h3 class="news-title">Upcoming Parent-Teacher Conference</h3>
                        <p class="news-excerpt">Mark your calendars for the upcoming parent-teacher conference scheduled
                            for May 15th. This is an important opportunity to discuss your child's progress.</p>
                        <div class="full-content">
                            <p>The conference will be held from 3:00 PM to 8:00 PM in the main auditorium. Each
                                appointment will last 15 minutes, allowing teachers to provide comprehensive feedback on
                                your child's academic performance, behavioral development, and social integration.</p>
                            <p>To schedule your preferred time slot, please use our online booking system available on
                                the school portal. If you require any special accommodations or have specific concerns
                                you would like to address, please indicate this when booking your appointment.</p>
                        </div>
                        <button class="read-more">Read More</button>
                    </div>
                </div>

                <!-- Small News Item -->
                <div class="news-article">
                    <div class="news-content">
                        <h3 class="news-title">Library Hours Extended</h3>
                        <p class="news-excerpt">Due to popular demand, our library will now remain open until 8 PM on
                            weekdays to accommodate students preparing for final exams.</p>
                        <div class="full-content">
                            <p>This extension will be effective immediately and continue throughout the exam period
                                until May 30th. The library will also be open on Saturdays from 10 AM to 4 PM during
                                this period.</p>
                            <p>Additional staff members have been assigned to help students with research and to
                                maintain the quiet study environment. The computer lab within the library will also
                                follow these extended hours, providing access to digital resources and research
                                databases.</p>
                        </div>
                        <button class="read-more">Read More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php     include("../includes/footer.php"); ?>

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
                                    otherElement.innerHTML.toLowerCase().includes(searchTerm)) {
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

                }
                else{
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