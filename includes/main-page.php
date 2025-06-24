<?php
// if (!defined('BASE_PATH')) {
//     die('Direct access not allowed');
// }
?>
 
<!-- fetch events -->
<?php
include("db.php");

$sql = "SELECT * FROM events  WHERE event_date >= CURDATE()    ORDER BY event_date ASC";
$result = $conn->query($sql);
?>
<style>
    /* Main content container */
    .main-container {
        display: flex;
        flex-wrap: wrap;
        /* width: 100%; */
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Left content */
    .main-content {
        flex: 1;
        min-width: 300px;
        width: 70%;
        padding-right: 20px;
    }

    /* Right sidebar */
    .sidebar {
        /* position: fixed; */

        width: 300px;
        background-color: #f5f5f5;
        padding: 0px 15px;
        border-radius: 5px;
        border-left: 1px solid hsl(22, 100.00%, 48.40%);
    }

    /* Hero section with carousel */
    .hero-carousel {
        position: relative;
        height: 400px;
        margin-bottom: 30px;
        overflow: hidden;
        border-radius: 8px;
    }

    .carousel-container {
        display: flex;
        transition: transform 0.5s ease-in-out;
        height: 100%;
    }

    .carousel-slide {
        min-width: 100%;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .carousel-slide::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
    }

    .carousel-caption {
        position: absolute;
        bottom: 50px;
        left: 50px;
        color: white;
        z-index: 10;
        max-width: 80%;
    }

    .carousel-caption h2 {
        font-size: 32px;
        margin-bottom: 15px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }

    .carousel-caption p {
        font-size: 18px;
        line-height: 1.5;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }

    .carousel-controls {
        position: absolute;
        bottom: 20px;
        right: 20px;
        display: flex;
        gap: 10px;
        z-index: 10;
    }

    .carousel-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        cursor: pointer;
    }

    .carousel-dot.active {
        background-color: white;
    }

    /* Section styling */
    .section {
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 24px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 4px solid rgb(214, 43, 43);
        color: #184e77;
    }

    /* Mission & Vision section */
    .mission-vision {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .mission-box,
    .vision-box {
        flex: 1;
        min-width: 300px;
        background-color: #f9f9f9;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .box-title {
        margin-top: 20px;
        font-size: 20px;
        color: #184e77;
        margin-bottom: 15px;
        text-align: center;
    }

    .box-content {
        line-height: 1.6;
        color: #333;
    }

    .box-icon {
        position: absolute;
        top: -19px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 50px;
        padding: 10px;
        background-color: #184e77;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }

    /* Strategic Goals section */
    .goals-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    #goals,
    #community,
    #activities,
    #mission,
    #news {
        background-color: #1a5276;
        width: fit-content;
        padding: 0px 20px;
        color: white;
    }

    .goal-item {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
    }

    .goal-number {
        font-size: 36px;
        font-weight: bold;
        color: #1a759f;
        margin-bottom: 10px;
    }

    .goal-title {
        font-size: 18px;
        font-weight: bold;
        color: #184e77;
        margin-bottom: 10px;
    }

    .goal-description {
        font-size: 14px;
        line-height: 1.5;
        color: #555;
        flex-grow: 1;
    }

    /* Community Engagement section */
    .community-content {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .partner-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* margin-top: 5px; */
    }

    .partner-details button {
        margin-top: 0px;
    }

    .community-image {
        flex: 1;
        min-width: 300px;
        height: 300px;
        background-size: cover;
        background-position: center;
        border-radius: 8px;
        overflow: hidden;
    }

    .community-text {
        flex: 1;
        min-width: 300px;
    }

    .community-text p {
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .community-partners {
        width: 50%;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }

    .community-partners h3 {
        text-align: center;
        background-color: #184e77;
        color: white;
        padding: 5px 20px;


    }

    .partner-logo {
        height: 60px;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        font-size: 12px;
        color: #666;
    }

    .partner-logos {
        display: flex;
        justify-content: space-evenly;
    }

    .partner-logo img {
        width: fit-content;
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        /* margin-right: 10px; */
        cursor: pointer;
        border: 1px solid black;
        border-radius: 10px;

    }

    .partner-logo img:hover {
        box-shadow: 1px 1px 5px 1px black;

    }

    /* Extracurricular Activities section */
    .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .activity-item {
        position: relative;
        height: 150px;
        border-radius: 8px;
        overflow: hidden;
        background-size: cover;
        background-position: center;
    }

    .activity-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 15px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0));
        color: white;
    }

    .activity-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Featured content section */
    .featured-content {
        margin-bottom: 30px;
    }

    .featured-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .featured-item {
        background-color: #f9f9f9;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .featured-item:hover {
        transform: translateY(-5px);
    }

    .featured-img {
        height: 180px;
        background-size: cover;
        background-position: center;
    }

    .featured-text {
        padding: 15px;
    }

    .featured-text h3 {
        margin-bottom: 10px;
        color: #184e77;
    }

    .featured-text p {
        font-size: 14px;
        line-height: 1.5;
        color: #555;
    }

    /* News & Announcements section */
    .news-section h2 {
        font-size: 20px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #184e77;
        color: #184e77;
    }

    .new-uploads {
        margin-top: 30px;
    }



    .news-item {
        padding: 15px 5px;
        border-bottom: 1px solid #ddd;
    }

    .news-item:last-child {
        border-bottom: none;
    }

    .news-date {
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
    }

    .news-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #184e77;
    }

    .news-excerpt {
        font-size: 14px;
        line-height: 1.4;
        color: #444;
    }

    .read-more {
        display: inline-block;
        margin-top: 10px;
        color: #1a759f;
        font-size: 12px;
        text-decoration: none;
        font-weight: bold;
    }

    .read-more:hover {
        text-decoration: underline;
    }

    /* Quick links */
    .quick-links {
        margin-top: 30px;
    }

    .quick-links h3 {
        font-size: 18px;
        margin-bottom: 15px;
        color: #184e77;
    }

    .links-list {
        list-style: none;
    }

    .links-list li {
        margin-bottom: 10px;
    }

    .links-list a {
        display: block;
        padding: 8px 12px;
        background-color: #e9ecef;
        color: #184e77;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .links-list a:hover {
        background-color: #dee2e6;
    }

    /* Call to action button */
    #cta-button {
        display: inline-block;
        padding: 12px 25px;
        background-color: #1a759f;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s;
        /* margin-top: 15px; */
    }

    #cta-button:hover {
        background-color: #184e77;
    }



    /* search styles */
    /* Search bar styles */
    .search-container {
        display: flex;
        position: relative;
        margin-bottom: 10px;
    }

    .search-bar {

        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        background-color: white;
        transition: box-shadow 0.2s ease;
    }

    .search-bar:focus-within {
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        border-color: #3b82f6;
    }

    .search-icon {
        display: flex;
        align-items: center;
        padding-left: 12px;
        color: #6b7280;
    }

    .search-input {
        flex: 1;
        padding: 12px 8px;
        border: none;
        outline: none;
        font-size: 16px;
    }

    .clear-button {
        background: none;
        border: none;
        padding: 0 12px;
        cursor: pointer;
        color: #6b7280;
    }

    .clear-button:hover {
        color: #4b5563;
    }

    .search-button {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 16px 5px 16px 5px;
        margin-left: -10px;
        height: 100%;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .search-button:hover {
        background-color: #2563eb;
    }

    /* Suggestions styles */
    .suggestions-container {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        margin-top: 4px;
        background-color: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        max-height: 320px;
        overflow-y: auto;
        z-index: 10;
    }

    .suggestion-item {
        padding: 8px 16px;
        cursor: pointer;
    }

    .suggestion-item:hover {
        background-color: #f3f4f6;
    }

    .suggestion-title {
        font-weight: 500;
    }

    .suggestion-content {
        font-size: 14px;
        color: #6b7280;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .loading-indicator {
        padding: 8px 16px;
        text-align: center;
        color: #6b7280;
    }

    /* Search results styles */
    .search-results {
        margin-top: 24px;
    }

    .results-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 16px;
    }
    .news-container{
        margin-top: 20px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .result-item {
        padding: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 16px;
        background-color: white;
        transition: border-color 0.2s ease;
    }

    .result-item:hover {
        border-color: #d1d5db;
    }

    .result-title {
        font-size: 18px;
        font-weight: 600;
        color: #2563eb;
    }

    .result-title:hover {
        text-decoration: underline;
    }

    .result-content {
        color: #4b5563;
        margin-top: 4px;
    }

    .no-results {
        padding: 24px;
        text-align: center;
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }

    .no-results-message {
        color: #4b5563;
    }

    .no-results-suggestion {
        font-size: 14px;
        color: #6b7280;
        margin-top: 8px;
    }

    /* Highlight style */
    .highlight {
        background-color: #fef08a;
    }

    .mypopup {
        /* position: absolute; */
        top: 34px;
        background-color: cyan;
        margin: auto;
        width: 50%;
        /* height: 50%; */
        padding: 50px;
        border-radius: 10px;
        border: 1px solid;
        z-index: 99;
        box-shadow: 1px 3px 3px black;
        transition: 5s ease-in-out;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .carousel-container {
        display: flex;
        transition: transform 0.5s ease-in-out;
        height: 100%;
        width: 100%;
    }
       
        .mission-vision {
            display: block; 
        }

        .quick-links {
            display: none
        }

        .community-partners {
            width: 100%;
        }

        .partner-logos {
            width: 100%;
        }

        .main-container {
            /* background-color: cyan; */
            flex-direction: column;
            width: 100%;
        }

        .main-content {
            padding-right: 0;
            margin-bottom: 20px;
            width: 100%;
        }

        .sidebar {
            width: 100%;
        }

        .hero-carousel {
            height: 300px;
        }

        .carousel-caption {
            left: 20px;
            bottom: 20px;
        }

        .carousel-caption h2 {
            font-size: 24px;
        }

        .carousel-caption p {
            font-size: 16px;
        }

        .mission-box,
        .vision-box {
            margin-bottom: 20px;
        }

        .news-container {
            height: fit-content;
            overflow-y: n;
        }

        .search-container {
            display: none;
        }

        .partner-details {
            text-align: center;
            width: 100%;
            display: block;
        }

        .partner-details button {

            margin-top: 30px;
        }
    }

    @media (max-width: 480px) {
        
        .mission-vision {
            display: block; 
        }

        .quick-links {
            display: none;
        }

        .community-partners {
            width: 100%;
        }

        .partner-logos {
            width: 100%;
        }

        .news-container {
            height: fit-content;
            overflow-y: hidden;
        }

        .hero-carousel {
            height: 220px;
        }

        .carousel-caption h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .carousel-caption p {
            font-size: 14px;
        }

        .section-title {
            font-size: 20px;
        }

        .search-container {
            display: none;
        }

        .partner-details {
            width: 100%;
            display: block;
        }

        .partner-details button {
            margin-top: 30px;
        }
    }
</style>

<div class="main-container">
    <main class="main-content">
        <!-- Hero carousel section -->
        <div class="hero-carousel">
            <div class="carousel-container">
                <div class="carousel-slide"
                    style="background-image: url('/RMS-Project/assets/images/62.jpg'); height: 600px;width:1000px">
                    <div class="carousel-caption">
                        <h2>Welcome to Our School</h2>
                        <p>Empowering students to achieve excellence in education</p>
                    </div>
                </div>
                <div class="carousel-slide" style="background-image: url('/RMS-Project/assets/images/46.jpg')">
                    <div class="carousel-caption">
                        <h2>Our School</h2>
                    </div>
                </div>
                <div class="carousel-slide" style="background-image: url('/RMS-Project/assets/images/19.jpg')">
                    <div class="carousel-caption">
                        <h2>Opening school event</h2>
                        <!-- <p>Empowering students to achieve excellence in education</p> -->
                    </div>
                </div>
                <div class="carousel-slide" style="background-image: url('/RMS-Project/assets/images/54.jpg')">
                    <div class="carousel-caption">
                        <h2>Academic Excellence</h2>
                        <p>Fostering a love for learning in every student</p>
                    </div>
                </div>
                <div class="carousel-slide" style="background-image: url('/RMS-Project/assets/images/53.jpg')">

                    <div class="carousel-caption">
                        <h2>Scientific</h2>
                        <p>Inside every child there is Scientific</p>
                    </div>
                </div>

            </div>
            <div class="carousel-controls">
                <div class="carousel-dot active"></div>
                <div class="carousel-dot"></div>
                <div class="carousel-dot"></div>
                <div class="carousel-dot"></div>
                <div class="carousel-dot"></div>

            </div>
        </div>

        <!-- Mission & Vision Section -->
        <section class="section">
            <h2 class="section-title" id="mission">Mission and Core Values</h2>
            <div class="mission-vision">
                <div class="mission-box">
                    <div class="box-icon">M</div>
                    <h3 class="box-title">Our Mission</h3>
                    <p class="box-content">
                        To foster a dynamic, inclusive, and future-ready learning environment that equips all students
                        with critical thinking, problem-solving, communication, and leadership skills through
                        innovative, student-centered teaching practices. By 2025, we aim to achieve a 100% graduation
                        rate and a 95% success rate in national examinations, while also promoting lifelong learning,
                        ethical responsibility, digital literacy, and global citizenship. Through strategic
                        partnerships, continuous professional development, and a commitment to equity and excellence, we
                        aspire to empower every learner to thrive in an ever-evolving world.
                    </p>
                </div>
                <div class="vision-box">
                    <div class="box-icon">C</div>
                    <h3 class="box-title">Core Values</h3>
                    <p class="box-content">
                        <ul type="square">
                            <li>Innovation in Education <br>
                                We use creative and new ways of teaching to make learning active, fun, and focused on
                                students.</li>
                            <li>Student-Centered Learning<br>
                                We prioritize individualized learning approaches that recognize each student’s unique
                                needs, abilities, and potential, ensuring they are actively involved in their education.
                            </li>
                            <li>Excellence<br>
                                We strive for excellence in all aspects of education, aiming for high academic
                                achievement</li>
                        </ul>

                    </p>
                </div>
            </div>
        </section>

        <!-- Strategic Goals Section -->
        <section class="section">
            <h2 id="goals" class="section-title">Strategic Goals</h2>
            <div class="goals-container">
                <div class="goal-item">
                    <div class="goal-number">01</div>
                    <h3 class="goal-title">Academic Excellence</h3>
                    <p class="goal-description">
                        Provide rigorous, relevant curriculum and instruction that ensures every student achieves their
                        highest potential for academic success and personal growth.
                    </p>
                </div>
                <div class="goal-item">
                    <div class="goal-number">02</div>
                    <h3 class="goal-title">Innovative Learning</h3>
                    <p class="goal-description">
                        Foster innovation in teaching and learning to prepare students for success in an increasingly
                        complex and technology-driven global society.
                    </p>
                </div>
                <div class="goal-item">
                    <div class="goal-number">03</div>
                    <h3 class="goal-title">Whole Child Development</h3>
                    <p class="goal-description">
                        Support the emotional, social, physical, and intellectual development of each student to ensure
                        they become well-rounded individuals.
                    </p>
                </div>
                <!-- <div class="goal-item">
                    <div class="goal-number">04</div>
                    <h3 class="goal-title">Community Partnership</h3>
                    <p class="goal-description">
                        Build and strengthen partnerships with families, businesses, and community organizations to
                        enrich educational experiences and support student success.
                    </p>
                </div> -->
            </div>
        </section>

        <!-- Community Engagement Section -->
        <section class="section">
            <h2 id="community" class="section-title">Community Engagement</h2>
            <div class="community-content">
                <div class="community-image" style="background-image: url('/RMS-Project/assets/images/7.jpg')">
                </div>
                <div class="community-text">
                    <p>
                        At our school, we believe that strong community connections enrich the educational experience of
                        our students.
                    </p>
                    <p>
                        Through service-learning projects, guest speaker programs, and collaborative initiatives, our
                        students develop a deeper understanding of their community and their role as engaged citizens.
                    </p>
                    <p>
                        We invite parents and community members to participate in school events to help shape the future
                        of our educational programs.
                    </p>
                </div>
            </div>
            <div class="partner-details">
                <div class="community-partners">
                    <div>
                        <h3>Our Partners</h3>
                    </div>
                    <div class="partner-logos">
                        <div class="partner-logo"> <img onclick="window.open('https://www.reb.gov.rw/home')"
                                src="https://th.bing.com/th/id/OIP.AL8E7QpIJYXvaQuvkh1sxAHaHa?rs=1&pid=ImgDetMain"
                                alt="parterner logo"></div>
                        <div class="partner-logo"><img onclick="window.open('https://ur.ac.rw/')"
                                src="https://www.tertiaryinstitutions.com/images/universities/logos/university_of_rwanda_ur.png"
                                alt="parterner logo"></div>
                        <div class="partner-logo"> <img onclick="window.open('https://www.reb.gov.rw/home')"
                                src="https://th.bing.com/th/id/OIP.AL8E7QpIJYXvaQuvkh1sxAHaHa?rs=1&pid=ImgDetMain"
                                alt="parterner logo"></div>
                    </div>
                    <div class="partner-logos" style="display: none;">
                        <div class="partner-logo"> <img onclick="window.open('https://www.reb.gov.rw/home')"
                                src="https://th.bing.com/th/id/OIP.AL8E7QpIJYXvaQuvkh1sxAHaHa?rs=1&pid=ImgDetMain"
                                alt="parterner logo"></div>
                        <div class="partner-logo"><img onclick="window.open('https://ur.ac.rw/')"
                                src="https://www.tertiaryinstitutions.com/images/universities/logos/university_of_rwanda_ur.png"
                                alt="parterner logo"></div>
                        <div class="partner-logo"> <img onclick="window.open('https://www.reb.gov.rw/home')"
                                src="https://th.bing.com/th/id/OIP.AL8E7QpIJYXvaQuvkh1sxAHaHa?rs=1&pid=ImgDetMain"
                                alt="parterner logo"></div>

                    </div>
                    <div class="partner-logos" style="display: none;">
                        <div class="partner-logo"> <img onclick="window.open('https://www.reb.gov.rw/home')"
                                src="https://th.bing.com/th/id/OIP.AL8E7QpIJYXvaQuvkh1sxAHaHa?rs=1&pid=ImgDetMain"
                                alt="parterner logo"></div>
                        <div class="partner-logo"><img onclick="window.open('https://ur.ac.rw/')"
                                src="https://www.tertiaryinstitutions.com/images/universities/logos/university_of_rwanda_ur.png"
                                alt="parterner logo"></div>
                        <div class="partner-logo"> <img onclick="window.open('https://www.reb.gov.rw/home')"
                                src="https://th.bing.com/th/id/OIP.AL8E7QpIJYXvaQuvkh1sxAHaHa?rs=1&pid=ImgDetMain"
                                alt="parterner logo"></div>

                    </div>
                </div>
                <button id="cta-button">Get involved</button><br>
                <!-- <div id="form-div"></div> -->
                <script>
                    document.getElementById("cta-button").addEventListener(
                        "click", showBox
                    );

                    function showBox() {
                        document.getElementById("form-div").innerHTML = `
                    <div class='mypopup'>
                        helllo there
                        <button onlclick="close">Close</button>
                        </div>
                    `;
                    }
                </script>

            </div>
        </section>

        <!-- Extracurricular Activities Section -->
        <section style="display: none;" class="section">
            <h2 id="activities" class="section-title">Extracurricular Activities</h2>
            <div class="activities-grid">
                <div class="activity-item"
                    style="background-image: url('https://tse4.mm.bing.net/th?id=OIP.qDvAlhidTBzXiGyDfq_O0gHaE7&pid=Api&P=0&h=220')">
                    <div class="activity-overlay">
                        <h3 class="activity-title">Sports Teams</h3>
                    </div>
                </div>
                <div class="activity-item"
                    style="background-image: url('https://tse4.mm.bing.net/th?id=OIP.qDvAlhidTBzXiGyDfq_O0gHaE7&pid=Api&P=0&h=220')">
                    <div class="activity-overlay">
                        <h3 class="activity-title">Debate Club</h3>
                    </div>
                </div>
                <div class="activity-item"
                    style="background-image: url('https://tse4.mm.bing.net/th?id=OIP.qDvAlhidTBzXiGyDfq_O0gHaE7&pid=Api&P=0&h=220')">
                    <div class="activity-overlay">
                        <h3 class="activity-title">Music & Band</h3>
                    </div>
                </div>
                <div class="activity-item"
                    style="background-image: url('https://tse4.mm.bing.net/th?id=OIP.qDvAlhidTBzXiGyDfq_O0gHaE7&pid=Api&P=0&h=220')">
                    <div class="activity-overlay">
                        <h3 class="activity-title">STEM Club</h3>
                    </div>
                </div>
                <div class="activity-item"
                    style="background-image: url('https://tse4.mm.bing.net/th?id=OIP.qDvAlhidTBzXiGyDfq_O0gHaE7&pid=Api&P=0&h=220')">
                    <div class="activity-overlay">
                        <h3 class="activity-title">Art & Theater</h3>
                    </div>
                </div>
                <div class="activity-item"
                    style="background-image: url('https://tse4.mm.bing.net/th?id=OIP.qDvAlhidTBzXiGyDfq_O0gHaE7&pid=Api&P=0&h=220')">
                    <div class="activity-overlay">
                        <h3 class="activity-title">Community Service</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured content section -->
        <section style="display: none;" class="featured-content">
            <h2 class="section-title">Featured Programs</h2>
            <div class="featured-grid">
                <article class="featured-item">
                    <div class="featured-img"
                        style="background-image: url('https://tse4.mm.bing.net/th?id=OIP.qDvAlhidTBzXiGyDfq_O0gHaE7&pid=Api&P=0&h=220')">
                    </div>
                    <div class="featured-text">
                        <h3>STEM Innovation</h3>
                        <p>Our award-winning STEM program prepares students for the challenges of tomorrow through
                            hands-on learning experiences.</p>
                    </div>
                </article>
                <article class="featured-item">
                    <div class="featured-img"
                        style="background-image: url('https://tse4.mm.bing.net/th?id=OIP.qDvAlhidTBzXiGyDfq_O0gHaE7&pid=Api&P=0&h=220')">
                    </div>
                    <div class="featured-text">
                        <h3>Arts & Creativity</h3>
                        <p>Discover your creative potential through our comprehensive arts curriculum featuring visual
                            arts, music, and theater.</p>
                    </div>
                </article>
                <article class="featured-item">
                    <div class="featured-img" style="background-image: url('/RMS-Project/assets/images/59.jpg')">
                    </div>
                    <div class="featured-text">
                        <h3>Athletics Program</h3>
                        <p>Our competitive sports teams foster teamwork, leadership, and physical wellness for students
                            at all skill levels.</p>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <!-- Right sidebar with News & Announcements -->
    <aside class="sidebar">
        <div class="search-container" id="searchContainer">
            <div class="search-bar">
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" id="searchInput" class="search-input" placeholder="Search content..."
                    autocomplete="off">
                <button id="clearButton" class="clear-button" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <button id="searchButton" class="search-button">Search</button>
            </div>

            <div id="suggestionsContainer" class="suggestions-container" style="display: none;"></div>

            <div id="loadingIndicator" class="suggestions-container" style="display: none;">
                <div class="loading-indicator">Loading suggestions...</div>
            </div>
        </div>

        <div id="searchResults" class="search-results" style="display: none;"></div>
        <section class="news-section">
            <h2 id="news">News & Announcements (<?php echo $result->num_rows ?>)</h2>
            <div style="margin-bottom: 1em;" class="news-container">
                   <?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h2 class='news-title'>" . $row["event_name"] . "</h2>";
        echo "<p><strong>Type:</strong> " . $row["event_type"] . "</p>";
        if ($row["mark"]!=null) {
        echo "<p><strong style='background-color: red;'>Date: " . $row["event_date"] . "</strong> <br> This event was scheduled at  <strike style='color: green;'>  " . $row["event_time"] . "</strike></p>";
        echo "<p><strong>Location:</strong> " . $row["event_location"] . "</p>";
        // echo "<p><strong>Description:</strong> " . $row["event_description"] . "</p>";
        echo "<p><strong>Participants:</strong> " . $row["event_participants"] . "</p>";
        echo "<hr>";
        // Go to news.php?id=" . $row["event_name"] . "
        // echo "<button class='view-details' onclick='window.location.href=\"/RMS-Project/pages/news.php?event_name=" . $row["event_name"] . "\"'>View Details</button>";
        // echo "<button class='view-details' onclick='window.location.href=\"/RMS-Project/pages/event_details.php?id=" . $row["id"] . "\"'>View Details</button>";
        }
        else{
        echo "<p><strong>Date:</strong> " . $row["event_date"] . " at " . $row["event_time"] . "</p>";
        echo "<p><strong>Location:</strong> " . $row["event_location"] . "</p>";
        // echo "<p><strong>Description:</strong> " . $row["event_description"] . "</p>";
        echo "<p><strong>Participants:</strong> " . $row["event_participants"] . "</p>";
        echo "<hr>";
        // Go to news.php?id=" . $row["event_name"] . "
        echo "<button class='view-details' onclick='window.location.href=\"/RMS-Project/pages/news.php?event_name=" . $row["event_name"] . "\";'>View Details</button>";
        // echo "<button class='view-details' onclick='window.location.href=\"/RMS-Project/pages/event_details.php?id=" . $row["id"] . "\"'>View Details</button>";
        }
        
        
    
    }
} else {
    echo "No events found.";
}
?>
<?php
$conn->close();
?>
            </div>
        </section>
        <section class="quick-links" style="display: none;">
            <h3>Quick Links</h3>
            <ul class="links-list">
                <li><a href="#">Academic Calendar</a></li>
                <li><a href="#">Student Portal</a></li>
                <li><a href="#">Admin Portal</a></li>
                <li><a href="#">Teacher Portal</a></li>

                <!-- <li><a href="#">Extracurricular Activities</a></li> -->
                <li><a href="">Contact Us</a></li>
                <li><a href="#">Academic Calendar</a></li>
            </ul>
        </section>
    </aside>
</div> 

              
<!-- <script src="newsdetails.js"></script> -->
<script src="/RMS-Project/setInfo.js"></script>
<!-- <script src="/RMS-Project/assets/js/newsdetails.js"></script> -->

<!-- <script   src="/RMS-Project/assets/js/main.js"></script> -->
<!-- <script src="/RMS-Project/assets/js/newsdetails.js"></script> -->

<script>
     
    // Simple carousel functionality
    document.addEventListener('DOMContentLoaded', function() {
        const carouselContainer = document.querySelector('.carousel-container');
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        const slideWidth = 100; // percentage
        let currentIndex = 0;
        // Initialize
        updateCarousel();
        // Setup automatic sliding
        setInterval(() => {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        }, 5000);
        // Add click events to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                updateCarousel();
            });
        });

        function updateCarousel() {
            // Update slides position
            carouselContainer.style.transform = `translateX(-${currentIndex * slideWidth}%)`;
            // Update dots
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
    });
  
    document.addEventListener('DOMContentLoaded', function() {
        // DOM Elements
        const searchInput = document.getElementById('searchInput');
        const clearButton = document.getElementById('clearButton');
        const searchButton = document.getElementById('searchButton');
        const suggestionsContainer = document.getElementById('suggestionsContainer');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const searchResults = document.getElementById('searchResults');
        const searchContainer = document.getElementById('searchContainer');
        // Sample website content for search demonstration
        const webpageContent = [{
                title: "Home Page",
                content: "Welcome to our website. We offer various services and products.",
                url: "#home"
            },
            {
                title: "About Us",
                content: "Learn more about our company history and mission statement.",
                url: "#about"
            },
            {
                title: "Products",
                content: "Browse our wide range of products including electronics, clothing, and accessories.",
                url: "#products"
            },
            {
                title: "Services",
                content: "We provide top-notch customer service and support for all your needs.",
                url: "#services"
            },
            {
                title: "Contact",
                content: "Get in touch with our support team via email, phone, or visit our office.",
                url: "#contact"
            },
            {
                title: "Blog",
                content: "Read our latest articles on technology, fashion, and industry trends.",
                url: "#blog"
            },
            {
                title: "FAQ",
                content: "Find answers to frequently asked questions about our products and services.",
                url: "#faq"
            },
            {
                title: "Privacy Policy",
                content: "Information about how we collect, use, and protect your personal data.",
                url: "#privacy"
            },
            {
                title: "Terms of Service",
                content: "Details about the terms and conditions of using our website and services.",
                url: "#terms"
            },
        ];
        // Variables
        let searchTimeout;
        let hasSearched = false;
        // Event Listeners
        searchInput.addEventListener('input', handleInput);
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        searchInput.addEventListener('focus', function() {
            if (searchInput.value.trim() !== '') {
                showSuggestions();
            }
        });
        clearButton.addEventListener('click', clearSearch);
        searchButton.addEventListener('click', performSearch);
        // Handle clicks outside the search container
        document.addEventListener('click', function(e) {
            if (!searchContainer.contains(e.target)) {
                suggestionsContainer.style.display = 'none';
            }
        });
        // Functions
        function handleInput() {
            const query = searchInput.value.trim();
            // Toggle clear button visibility
            clearButton.style.display = query ? 'block' : 'none';
            if (query === '') {
                suggestionsContainer.style.display = 'none';
                loadingIndicator.style.display = 'none';
                clearTimeout(searchTimeout);
                return;
            }
            // Show loading indicator
            loadingIndicator.style.display = 'block';
            suggestionsContainer.style.display = 'none';
            // Clear previous timeout
            clearTimeout(searchTimeout);
            // Set new timeout for search suggestions
            searchTimeout = setTimeout(() => {
                generateSuggestions(query);
            }, 300);
        }

        function generateSuggestions(query) {
            // Filter content based on query
            const filteredContent = webpageContent.filter(item =>
                item.title.toLowerCase().includes(query.toLowerCase()) ||
                item.content.toLowerCase().includes(query.toLowerCase())
            ).slice(0, 5);
            // Hide loading indicator
            loadingIndicator.style.display = 'none';
            // Show suggestions if there are any
            if (filteredContent.length > 0) {
                suggestionsContainer.innerHTML = '';
                filteredContent.forEach(item => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.className = 'suggestion-item';
                    const titleElement = document.createElement('div');
                    titleElement.className = 'suggestion-title';
                    titleElement.innerHTML = highlightMatch(item.title, query);
                    const contentElement = document.createElement('div');
                    contentElement.className = 'suggestion-content';
                    contentElement.innerHTML = highlightMatch(item.content.substring(0, 60) + '...',
                        query);
                    suggestionItem.appendChild(titleElement);
                    suggestionItem.appendChild(contentElement);
                    // Add click event to select suggestion
                    suggestionItem.addEventListener('click', function() {
                        selectSuggestion(item);
                    });
                    suggestionsContainer.appendChild(suggestionItem);
                });
                suggestionsContainer.style.display = 'block';
            } else {
                suggestionsContainer.style.display = 'none';
            }
        }

        function performSearch() {
            const query = searchInput.value.trim();
            if (query === '') return;
            // Filter content based on query
            const results = webpageContent.filter(item =>
                item.title.toLowerCase().includes(query.toLowerCase()) ||
                item.content.toLowerCase().includes(query.toLowerCase())
            );
            // Display results
            displaySearchResults(results, query);
            // Hide suggestions
            suggestionsContainer.style.display = 'none';
            hasSearched = true;
        }

        function displaySearchResults(results, query) {
            searchResults.innerHTML = '';
            // Create results title
            const resultsTitle = document.createElement('h2');
            resultsTitle.className = 'results-title';
            resultsTitle.textContent = `Search Results ${results.length > 0 ? `(${results.length})` : ''}`;
            searchResults.appendChild(resultsTitle);
            if (results.length > 0) {
                // Create results list
                results.forEach(result => {
                    const resultItem = document.createElement('div');
                    resultItem.className = 'result-item';
                    const resultLink = document.createElement('a');
                    resultLink.href = result.url;
                    resultLink.style.textDecoration = 'none';
                    const titleElement = document.createElement('h3');
                    titleElement.className = 'result-title';
                    titleElement.innerHTML = highlightMatch(result.title, query);
                    const contentElement = document.createElement('p');
                    contentElement.className = 'result-content';
                    contentElement.innerHTML = highlightMatch(result.content, query);
                    resultLink.appendChild(titleElement);
                    resultLink.appendChild(contentElement);
                    resultItem.appendChild(resultLink);
                    searchResults.appendChild(resultItem);
                });
            } else {
                // No results found
                const noResults = document.createElement('div');
                noResults.className = 'no-results';
                const noResultsMessage = document.createElement('p');
                noResultsMessage.className = 'no-results-message';
                noResultsMessage.textContent = `No results found for "${query}"`;
                const noResultsSuggestion = document.createElement('p');
                noResultsSuggestion.className = 'no-results-suggestion';
                noResultsSuggestion.textContent = 'Try using different keywords or check your spelling';
                noResults.appendChild(noResultsMessage);
                noResults.appendChild(noResultsSuggestion);
                searchResults.appendChild(noResults);
            }
            searchResults.style.display = 'block';
        }

        function selectSuggestion(suggestion) {
            searchInput.value = suggestion.title;
            displaySearchResults([suggestion], suggestion.title);
            suggestionsContainer.style.display = 'none';
            hasSearched = true;
        }

        function clearSearch() {
            searchInput.value = '';
            clearButton.style.display = 'none';
            suggestionsContainer.style.display = 'none';
            searchResults.style.display = 'none';
            hasSearched = false;
        }

        function showSuggestions() {
            const query = searchInput.value.trim();
            if (query !== '') {
                generateSuggestions(query);
            }
        }

        function highlightMatch(text, query) {
            if (!query) return text;
            const regex = new RegExp(`(${escapeRegExp(query)})`, 'gi');
            return text.replace(regex, '<span class="highlight">$1</span>');
        }

        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }
    });
 
    const isInViewport = (element) => {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.bottom >= 0
        );
    };
 
 
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const targetElement = document.querySelector(targetId);
            const navHeight = document.querySelector('header').offsetHeight;
            window.scrollTo({
                top: targetElement.offsetTop - navHeight,
                behavior: 'smooth'
            });
        });
    });
 
</script>
