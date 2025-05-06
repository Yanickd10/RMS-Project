<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TEP - Teaching Enhancement Program</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --light: #f8fafc;
            --dark: #1e293b;
            --success: #10b981;
            --info: #0ea5e9;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background-color: #f8fafc;
            color: var(--dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark);
        }

        .section-title span {
            color: var(--primary);
        }

        /* Header */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }

        .nav-menu {
            display: flex;
            list-style: none;
        }

        .nav-item {
            margin-left: 30px;
        }

        .story-modal-content {
            padding: 20px;
        }

        .story-author-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .full-story-text {
            max-height: 60vh;
            overflow-y: auto;
            line-height: 1.6;
            padding-right: 10px;
        }

        .full-story-text::-webkit-scrollbar {
            width: 6px;
        }

        .full-story-text::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .full-story-text::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }


        .nav-link {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .hamburger {
            display: none;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/api/placeholder/1200/800') center/cover no-repeat;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            padding-top: 80px;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        /* About Section */
        .about-text {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.8;
        }

        /* Program Stats */
        .stats {
            background-color: var(--primary);
            color: white;
        }

        .stats-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
        }

        .stat-box {
            text-align: center;
            flex: 1;
            min-width: 200px;
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .stat-counter {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .stat-title {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* What We Offer */
        .services {
            background-color: var(--light);
        }

        .services-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .service-card {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .service-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        /* Ratings Section */
        .ratings {
            background-color: white;
        }

        .overall-rating {
            text-align: center;
            margin-bottom: 40px;
        }

        .stars {
            font-size: 2rem;
            color: #f59e0b;
            margin-bottom: 10px;
        }

        .rating-text {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .rating-bars {
            max-width: 600px;
            margin: 0 auto 40px;
        }

        .rating-item {
            margin-bottom: 20px;
        }

        .rating-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .rating-bar {
            height: 10px;
            background-color: #e2e8f0;
            border-radius: 5px;
            overflow: hidden;
        }

        .rating-fill {
            height: 100%;
            background-color: var(--primary);
            border-radius: 5px;
            transition: width 1.5s ease-in-out;
        }

        .rate-us {
            text-align: center;
            margin-bottom: 40px;
        }

        /* Reviews */
        .reviews-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .review-card {
            background-color: var(--light);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .review-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
            color: white;
        }

        .review-author {
            font-weight: 600;
        }

        .review-stars {
            color: #f59e0b;
            margin-top: 5px;
        }

        .review-text {
            font-style: italic;
            margin-top: 10px;
        }

        /* Success Stories */
        .success-stories {
            background-color: var(--light);
        }

        .stories-slider {
            position: relative;
            overflow: hidden;
        }

        .stories-container {
            display: flex;
            transition: transform 0.5s ease;
        }

        .story-card {
            flex: 0 0 100%;
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin: 0 15px;
        }

        .story-quote {
            font-size: 1.2rem;
            font-style: italic;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .story-author {
            display: flex;
            align-items: center;
        }

        .story-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
            background-color: #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
        }

        .story-info h4 {
            font-weight: 600;
        }

        .story-info p {
            color: var(--secondary);
            margin-top: 5px;
        }

        .story-nav {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .story-nav-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .story-nav-btn:hover {
            background-color: var(--primary);
            color: white;
        }



        .structure-diagram {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 900px;
            margin: 0 auto;
        }

        .structure-level {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .structure-node {
            background-color: var(--primary);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            min-width: 200px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .structure-arrow {
            text-align: center;
            font-size: 2rem;
            color: var(--secondary);
            margin-bottom: 20px;
        }

        /* Partners */
        .partners {
            background-color: var(--light);
        }

        .partners-logos {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .partner-logo {
            width: 150px;
            height: 100px;
            background-color: white;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .partner-logo:hover {
            transform: translateY(-5px);
        }

        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 50px 0;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .footer-column {
            flex: 1;
            min-width: 250px;
        }

        .footer-column h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            text-decoration: none;
            color: #cbd5e1;
            transition: 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .social-icon:hover {
            background-color: var(--primary);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #334155;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            width: 90%;
            max-width: 500px;
            border-radius: 10px;
            padding: 30px;
            position: relative;
            animation: modalOpen 0.3s;
        }

        @keyframes modalOpen {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-modal:hover {
            color: var(--danger);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            transition: 0.3s;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .rating-select {
            display: flex;
            gap: 10px;
            font-size: 1.5rem;
        }

        .rating-star {
            cursor: pointer;
            color: #cbd5e1;
            transition: 0.3s;
        }

        .rating-star:hover,
        .rating-star.active {
            color: #f59e0b;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero h1 {
                font-size: 2.8rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .story-card {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .story-author-info {
                flex-direction: column;
                text-align: center;
            }

            .full-story-text {
                font-size: 0.9rem;
            }

            .hero h1 {
                font-size: 2.3rem;
            }

            .nav-menu {
                position: fixed;
                top: -100%;
                left: 0;
                width: 100%;
                background-color: white;
                flex-direction: column;
                text-align: center;
                transition: 0.3s;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                padding: 20px 0;
            }

            .nav-menu.active {
                top: 80px;
            }

            .nav-item {
                margin: 10px 0;
            }

            .hamburger {
                display: block;
            }

            .footer-content {
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2rem;
            }

            .stat-counter {
                font-size: 2.5rem;
            }

            .structure-node {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php
    // include("includes/navigation.php");
    ?>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo"> <svg onclick="window.location.href = '/RMS-Project/index'" style="cursor: pointer"
                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                    </svg> </div>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="#home" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#services" class="nav-link">What We Offer</a></li>
                    <li class="nav-item"><a href="#ratings" class="nav-link">Ratings</a></li>
                    <li class="nav-item"><a href="#success-stories" class="nav-link">Success Stories</a></li> 

                </ul>
                <div class="hamburger">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <main>

        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="container">
                <div class="hero-content">
                    <h1>Teaching Enhancement Program</h1>
                    <p>Empowering the next generation of educators through excellence, mentorship, and practical
                        experience.</p>
                    <button type="button" onclick="window.location.href = '/RMS-Project/login/'" class="btn btn-primary login-btn">LOGIN</button>
                </div>
            </div>
        </section>
        <!-- About Section -->
        <section class="about" id="about">
            <div class="container">
                <h2 class="section-title">About <span>TEP</span></h2>
                <div class="about-text">
                    <p>The Teaching Enhancement Program (TEP) is a comprehensive initiative designed to prepare aspiring
                        educators for successful teaching careers. Through hands-on experience, personalized mentorship,
                        and innovative workshops, TEP participants develop the skills, knowledge, and confidence needed
                        to excel in diverse educational settings.</p>
                </div>
            </div>
        </section>
        <!-- Program Stats Section -->
        <section class="stats">
            <div class="container">
                <div class="stats-container">
                    <div class="stat-box">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-counter" data-target="425">0</div>
                        <div class="stat-title">Alumni</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-counter" data-target="102">0</div>
                        <div class="stat-title">Current Scholars</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- What We Offer Section -->
        <section class="services" id="services">
            <div class="container">
                <h2 class="section-title">What We <span>Offer</span></h2>
                <div class="services-container">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="service-title">Teaching Practice</h3>
                        <p>Gain hands-on teaching experience in real classroom environments with supportive feedback and
                            guidance.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <h3 class="service-title">Mentoring</h3>
                        <p>Connect with experienced educators who provide personalized guidance and support throughout
                            your journey.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 class="service-title">Career Development</h3>
                        <p>Access professional development opportunities, job placement assistance, and networking
                            events.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h3 class="service-title">Workshops</h3>
                        <p>Participate in innovative workshops on teaching methodologies, classroom management, and
                            educational technology.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ratings Section -->
        <section class="ratings" id="ratings">
            <div class="container">
                <h2 class="section-title">Ratings & <span>Reviews</span></h2>

                <div class="overall-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="rating-text">4.6/5 Overall Program Rating</div>
                </div>
                <div class="rating-bars">
                    <div class="rating-item">
                        <div class="rating-label">
                            <span>Teaching Practice Experience</span>
                            <span>4.8/5</span>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-fill" style="width: 0%;" data-width="96%"></div>
                        </div>
                    </div>

                    <div class="rating-item">
                        <div class="rating-label">
                            <span>Mentorship Support</span>
                            <span>4.7/5</span>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-fill" style="width: 0%;" data-width="94%"></div>
                        </div>
                    </div>

                    <div class="rating-item">
                        <div class="rating-label">
                            <span>Career Development</span>
                            <span>4.5/5</span>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-fill" style="width: 0%;" data-width="90%"></div>
                        </div>
                    </div>

                    <div class="rating-item">
                        <div class="rating-label">
                            <span>Resource Availability</span>
                            <span>4.4/5</span>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-fill" style="width: 0%;" data-width="88%"></div>
                        </div>
                    </div>
                </div>

                <div class="rate-us">
                    <!-- <button class="btn" id="rateBtn">Rate Us</button> -->
                    <button type="button" class="btn btn-success" id="rateBtn">Rate us</button>
                </div>

                <div class="reviews-container">
                    <div class="review-card">
                        <div class="review-header">
                            <div class="review-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <div class="review-author">Sarah Johnson</div>
                                <div class="review-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="review-text">
                            "The Teaching Enhancement Program transformed my approach to education. The mentorship was
                            outstanding and the practical classroom experience was invaluable."
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-header">
                            <div class="review-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <div class="review-author">Michael Rodriguez</div>
                                <div class="review-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="review-text">
                            "TEP provided me with the confidence and skills I needed to excel in my teaching career. The
                            workshops were practical and the mentors were supportive."
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-header">
                            <div class="review-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <div class="review-author">Emma Thompson</div>
                                <div class="review-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="review-text">
                            "The resources and connections I gained through TEP have been instrumental in my success as
                            an educator. Highly recommend this program to anyone pursuing a teaching career."
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Stories Section -->
        <section class="success-stories" id="success-stories">
            <div class="container">
                <h2 class="section-title">Success <span>Stories</span></h2>

                <div class="stories-slider">
                    <div class="stories-container">
                        <div class="story-card">
                            <div class="story-quote">
                                "After completing the TEP program, I was offered a teaching position... (full story
                                text)"
                            </div>
                            <div class="story-author">
                                <div class="story-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="story-info">
                                    <h4>Marcus Johnson</h4>
                                    <p>Educational Program Director</p>
                                    <a href="#" class="read-more" onclick="showFullStory(this)">Read Full Story</a>
                                </div>
                            </div>
                        </div>
                        <div class="story-card">
                            <div class="story-quote">
                                "After completing the TEP program, I was offered a teaching position... (full story
                                text)"
                            </div>
                            <div class="story-author">
                                <div class="story-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="story-info">
                                    <h4>Marcus Johnson</h4>
                                    <p>Educational Program Director</p>
                                    <a href="#" class="read-more" onclick="showFullStory(this)">Read Full Story</a>
                                </div>
                            </div>
                        </div>
                        <div class="story-card">
                            <div class="story-quote">
                                "After completing the TEP program, I was offered a teaching position... (full story
                                text)"
                            </div>
                            <div class="story-author">
                                <div class="story-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="story-info">
                                    <h4>Marcus Johnson</h4>
                                    <p>Educational Program Director</p>
                                    <a href="#" class="read-more" onclick="showFullStory(this)">Read Full Story</a>
                                </div>
                            </div>
                        </div>
                        <div class="story-card">
                            <div class="story-quote">
                                "LOrem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                                incididunt ut labore et"
                            </div>
                            <div class="story-author">
                                <div class="story-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="story-info">
                                    <h4>Marcus Johnson</h4>
                                    <p>Educational Program Director</p>
                                    <a href="#" class="read-more" onclick="showFullStory(this)">Read Full Story</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="story-nav">
                <div class="story-nav-btn prev-story">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="story-nav-btn next-story">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            </div>
            </div>

            <!-- Add this new modal for full stories -->
            <div class="modal" id="storyModal">
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <div class="story-modal-content">
                        <div class="story-author-info">
                            <div class="story-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h4 class="author-name"></h4>
                                <p class="author-position"></p>
                            </div>
                        </div>
                        <div class="full-story-text"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Partners Section -->
        <section class="partners" id="partners">
            <div class="container">
                <h2 class="section-title">Partners & <span>Sponsors</span></h2>

                <div class="partners-logos">
                    <div class="partner-logo">
                        <i class="fas fa-university fa-3x"></i>
                    </div>
                    <div class="partner-logo">
                        <i class="fas fa-book fa-3x"></i>
                    </div>
                    <div class="partner-logo">
                        <i class="fas fa-building fa-3x"></i>
                    </div>
                    <div class="partner-logo">
                        <i class="fas fa-landmark fa-3x"></i>
                    </div>
                    <div class="partner-logo">
                        <i class="fas fa-school fa-3x"></i>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>TEP</h3>
                    <p>The Teaching Enhancement Program is committed to preparing the next generation of educators
                        through innovative teaching methods, mentorship, and real-world experience.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i style="color: white;" class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i style="color: white;" class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i style="color: white;" class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i style="color: white;" class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">What We Offer</a></li>
                        <li><a href="#ratings">Ratings</a></li>
                        <li><a href="#success-stories">Success Stories</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Education Avenue, Learning City</li>
                        <li><i class="fas fa-phone"></i> (555) 123-4567</li>
                        <li><i class="fas fa-envelope"></i> info@tep.edu</li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2025 Teaching Enhancement Program. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Rating Modal -->
    <div class="modal" id="ratingModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Rate Your Experience</h2>
            <form id="ratingForm">
                <div class="form-group">
                    <label class="form-label">Your Rating</label>
                    <div class="rating-select">
                        <i class="fas fa-star rating-star" data-value="1"></i>
                        <i class="fas fa-star rating-star" data-value="2"></i>
                        <i class="fas fa-star rating-star" data-value="3"></i>
                        <i class="fas fa-star rating-star" data-value="4"></i>
                        <i class="fas fa-star rating-star" data-value="5"></i>
                    </div>
                    <input type="hidden" id="ratingValue" value="0">
                </div>

                <div class="form-group">
                    <label class="form-label" for="name">Your Name</label>
                    <input type="text" id="name" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Your Email</label>
                    <input type="email" id="email" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="review">Your Review</label>
                    <textarea id="review" class="form-textarea" required></textarea>
                </div>

                <button type="submit" class="btn">Submit Review</button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal" id="successModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Thank You!</h2>
            <p>Your review has been submitted successfully. We appreciate your feedback!</p>
            <button class="btn close-success-modal">Close</button>
        </div>
    </div>

    <script>
        // Mobile Navigation
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
            });
        });
        // Smooth Scrolling
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
        // Counter Animation
        const counterElements = document.querySelectorAll('.stat-counter');

        function animateCounters() {
            counterElements.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const count = parseInt(counter.innerText);
                const increment = target / 100;
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(animateCounters, 10);
                } else {
                    counter.innerText = target;
                }
            });
        }
        // Rating Bar Animation
        const ratingBars = document.querySelectorAll('.rating-fill');

        function animateRatingBars() {
            ratingBars.forEach(bar => {
                const targetWidth = bar.getAttribute('data-width');
                bar.style.width = targetWidth;
            });
        }
        // Stories Slider
        const storiesContainer = document.querySelector('.stories-container');
        const storyCards = document.querySelectorAll('.story-card');
        const prevBtn = document.querySelector('.prev-story');
        const nextBtn = document.querySelector('.next-story');
        let currentIndex = 0;

        function updateStorySlider() {
            const translateValue = -currentIndex * 100 + '%';
            storiesContainer.style.transform = `translateX(${translateValue})`;
        }
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex === 0) ? storyCards.length - 1 : currentIndex - 1;
            updateStorySlider();
        });
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex === storyCards.length - 1) ? 0 : currentIndex + 1;
            updateStorySlider();
        });
        // Auto slide every 5 seconds
        setInterval(() => {
            currentIndex = (currentIndex === storyCards.length - 1) ? 0 : currentIndex + 1;
            updateStorySlider();
        }, 5000);
        // Rating Modal
        const ratingModal = document.getElementById('ratingModal');
        const successModal = document.getElementById('successModal');
        const rateBtn = document.getElementById('rateBtn');
        const closeModalBtns = document.querySelectorAll('.close-modal');
        const ratingStars = document.querySelectorAll('.rating-star');
        const ratingForm = document.getElementById('ratingForm');
        // Attach close event for all modal close buttons
        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                ratingModal.style.display = 'none';
                successModal.style.display = 'none';
                document.getElementById('storyModal').style.display = 'none';
            });
        });
        rateBtn.addEventListener('click', () => {
            ratingModal.style.display = 'flex';
        });
        window.addEventListener('click', (e) => {
            if (e.target === ratingModal) {
                ratingModal.style.display = 'none';
            }
            if (e.target === successModal) {
                successModal.style.display = 'none';
            }
            if (e.target === document.getElementById('storyModal')) {
                document.getElementById('storyModal').style.display = 'none';
            }
        });
        // Star Rating
        ratingStars.forEach(star => {
            star.addEventListener('click', () => {
                const value = star.getAttribute('data-value');
                document.getElementById('ratingValue').value = value;
                ratingStars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
        });
        // Submit Rating Form
        ratingForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // Get form values
            const rating = document.getElementById('ratingValue').value;
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const review = document.getElementById('review').value;
            // Here you would typically send this data to your backend
            console.log('Rating submitted:', {
                rating,
                name,
                email,
                review
            });
            // Show success modal
            ratingModal.style.display = 'none';
            successModal.style.display = 'flex';
            // Reset form
            ratingForm.reset();
            ratingStars.forEach(s => s.classList.remove('active'));
            // In a real implementation, you'd add the new review to the page
            // This is just a simulation for the demo
            addNewReview(name, rating, review);
        });
        // Simulate adding a new review to the page
        function addNewReview(name, rating, review) {
            const reviewsContainer = document.querySelector('.reviews-container');
            // Create new review card
            const newReview = document.createElement('div');
            newReview.className = 'review-card';
            // Generate star HTML based on rating
            let starsHTML = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    starsHTML += '<i class="fas fa-star"></i>';
                } else {
                    starsHTML += '<i class="far fa-star"></i>';
                }
            }
            // Set inner HTML for the new review
            newReview.innerHTML = `
                <div class="review-header">
                    <div class="review-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div class="review-author">${name}</div>
                        <div class="review-stars">
                            ${starsHTML}
                        </div>
                    </div>
                </div>
                <div class="review-text">
                    "${review}"
                </div>
            `;
            // Add to page with animation
            newReview.style.opacity = '0';
            reviewsContainer.prepend(newReview);
            setTimeout(() => {
                newReview.style.transition = 'opacity 0.5s ease';
                newReview.style.opacity = '1';
            }, 10);
        }
        // Animate on scroll
        const isInViewport = (element) => {
            const rect = element.getBoundingClientRect();
            return (
                rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.bottom >= 0
            );
        };
        // Initialize animations when elements come into view
        const handleScroll = () => {
            if (isInViewport(document.querySelector('.stats'))) {
                animateCounters();
            }
            if (isInViewport(document.querySelector('.ratings'))) {
                animateRatingBars();
            }
        };
        // Run animations on page load and scroll
        window.addEventListener('load', handleScroll);
        window.addEventListener('scroll', handleScroll);
        // Fetch data from backend
        // In a real implementation, you would fetch program stats, ratings, and reviews from your backend
        function fetchProgramData() {
            // Simulate API call with sample data
            const programData = {
                alumni: 425,
                currentScholars: 102,
                ratings: {
                    overall: 4.6,
                    teachingPractice: 4.8,
                    mentorship: 4.7,
                    careerDevelopment: 4.5,
                    resources: 4.4
                }
            };
            // Update the UI with the fetched data
            // For a real implementation, this would happen after the API call completes
            updateProgramStats(programData);
        }

        function updateProgramStats(data) {
            // Update counter targets
            document.querySelector('[data-target="425"]').setAttribute('data-target', data.alumni);
            document.querySelector('[data-target="102"]').setAttribute('data-target', data.currentScholars);
            // Update ratings
            const ratingItems = document.querySelectorAll('.rating-item');
            ratingItems[0].querySelector('.rating-label span:last-child').textContent = data.ratings.teachingPractice +
                '/5';
            ratingItems[1].querySelector('.rating-label span:last-child').textContent = data.ratings.mentorship + '/5';
            ratingItems[2].querySelector('.rating-label span:last-child').textContent = data.ratings.careerDevelopment +
                '/5';
            ratingItems[3].querySelector('.rating-label span:last-child').textContent = data.ratings.resources + '/5';
            // Update rating bars
            ratingItems[0].querySelector('.rating-fill').setAttribute('data-width', (data.ratings.teachingPractice / 5 *
                100) + '%');
            ratingItems[1].querySelector('.rating-fill').setAttribute('data-width', (data.ratings.mentorship / 5 *
                100) + '%');
            ratingItems[2].querySelector('.rating-fill').setAttribute('data-width', (data.ratings.careerDevelopment /
                5 * 100) + '%');
            ratingItems[3].querySelector('.rating-fill').setAttribute('data-width', (data.ratings.resources / 5 * 100) +
                '%');
            // Update overall rating
            document.querySelector('.rating-text').textContent = data.ratings.overall + '/5 Overall Program Rating';
        }
        // Call the fetch function on page load
        fetchProgramData();
        function showFullStory(element) {
            const storyCard = element.closest('.story-card');
            const fullStory = storyCard.querySelector('.story-quote').innerText;
            const authorName = storyCard.querySelector('h4').innerText;
            const authorPosition = storyCard.querySelector('p').innerText;
            // Populate modal content
            document.querySelector('.author-name').textContent = authorName;
            document.querySelector('.author-position').textContent = authorPosition;
            document.querySelector('.full-story-text').textContent = fullStory;
            // Show modal
            document.getElementById('storyModal').style.display = 'flex';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>