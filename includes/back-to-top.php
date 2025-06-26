<?php
// Prevent direct access
if (!defined('SECURE_ACCESS')) {
    http_response_code(403);
    exit('Access denied');
}
?> 
<style>
    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background-color:rgb(12, 40, 57);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .back-to-top.show {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background-color: #2980b9;
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .back-to-top i {
        font-size: 20px;
        transition: all 0.3s ease;
    }

    .back-to-top:hover i {
        animation: bounce 0.8s ease infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-8px);
        }

        60% {
            transform: translateY(-4px);
        }
    }

    /* For smaller screens, adjust size and position */
    @media screen and (max-width: 768px) {
        .back-to-top {
            width: 45px;
            height: 45px;
            bottom: 20px;
            right: 20px;
        }
    }

    @media screen and (max-width: 576px) {
        .back-to-top {
            width: 40px;
            height: 40px;
            bottom: 15px;
            right: 15px;
        }

        .back-to-top i {
            font-size: 18px;
        }
    }
</style>
<div class="back-to-top" id="backToTop">
    <i class="fas fa-arrow-up"></i>
</div>

<!-- JavaScript for Back to Top Button -->
<script>
    // Back to Top Button Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.getElementById('backToTop');
        // Show button when scrolling down 300px from the top
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });
        // Smooth scroll to top when button is clicked
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>