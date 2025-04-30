<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../includes/header-links.php');?>
<link rel="stylesheet" href="/RMS-Project/assets/css/nav.css">
    <title>About Us</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
    
        /* @import url("assets/css/footer.css"); */
        /* Custom CSS */
        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #2c3e50;
        }

        /* School History Section */
        .history-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Administration Team */
        .admin-team {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .admin-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .admin-card img { 
            object-fit: cover;
         
        }

        .admin-info {
            padding: 1.5rem;
        }

        /* Staff Profiles */
        .staff-profiles {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .staff-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .staff-card img, .admin-card img {
           /* border: 1px solid rgb(7, 7, 7); */
           border-bottom: 3px solid #3498db;
            margin-top: 10px;
            width: fit-content;
            border-radius: 50%;
            height: fit-content;
            object-fit: cover;
        }

        .staff-info {
            padding: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .about-container {
                padding: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .admin-team {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<?php include("../includes/navigation.php"); ?>

    <main class="about-container">
        <!-- School History Section -->
        <section class="history-section" id="history">
            <h2 class="section-title">Our School History</h2>
            <div class="history-card">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit officiis officia numquam error maiores nobis eos minima fuga ipsa mollitia! Voluptatum laudantium blanditiis cupiditate nostrum deserunt, ut distinctio sunt vero!
                Dolores doloremque quia sapiente fuga recusandae vel sequi eveniet nobis molestias enim, ipsa reiciendis quas. Quas totam, quibusdam, quasi nostrum nemo at, omnis iure enim in ea eum aliquam repellat.
             <br><br>
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit illum quis nemo impedit nihil id rem, perspiciatis soluta? Tempore voluptatem magnam dicta quo voluptatibus explicabo excepturi totam aliquid exercitationem. Temporibus.
             Nihil illo a velit dignissimos quidem itaque maxime maiores. Neque, animi ab a, amet odit aliquid qui eum soluta labore beatae aut ex libero aspernatur nulla! Alias dolores id praesentium.
             Inventore natus soluta eius atque voluptas odit tenetur iusto? Quibusdam, deserunt nesciunt, voluptatem beatae voluptatum officiis repudiandae eum nisi quis eius itaque quos temporibus culpa soluta ducimus odit tenetur provident?
             </div>
        </section>

        <!-- Administration Team Section -->
        <section class="administration-section" id="administration">
            <h2 class="section-title">Administration Team</h2>
            <div class="admin-team">
                <div class="admin-card">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.vgT-xN93AGkhrGpIEaz-sgHaJG&pid=Api&P=0&h=220" alt="Principal">
                    <div class="admin-info">
                    <h3>Admin Name</h3>
                        <p>Principal</p>
                    </div>
                </div>
                <div class="admin-card">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.vgT-xN93AGkhrGpIEaz-sgHaJG&pid=Api&P=0&h=220" alt="Vice Principal">
                    <div class="admin-info">
                    <h3>Admin Name</h3>
                        <p>Vice Principal</p>
                    </div>
                </div>
                <div class="admin-card">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.vgT-xN93AGkhrGpIEaz-sgHaJG&pid=Api&P=0&h=220" alt="Administrative Head">
                    <div class="admin-info">
                        <h3>Admin Name</h3>
                        <p>Administrative Head</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Staff Profiles Section -->
        <section class="staff-section" id="staff">
            <h2 class="section-title">Our Staff</h2>
            <div class="staff-profiles">
                <div class="staff-card">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.vgT-xN93AGkhrGpIEaz-sgHaJG&pid=Api&P=0&h=220" alt="Jane Doe">
                    <div class="staff-info">
                        <h3>Teache name</h3>
                        <p>Mathematics Teacher</p>
                    </div>
                </div>
                <div class="staff-card">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.vgT-xN93AGkhrGpIEaz-sgHaJG&pid=Api&P=0&h=220" alt="Robert Brown">
                    <div class="staff-info">
                    <h3>Teache name</h3>
                        <p>Science Teacher</p>
                    </div>
                </div>
                <div class="staff-card">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.vgT-xN93AGkhrGpIEaz-sgHaJG&pid=Api&P=0&h=220" alt="Emily White">
                    <div class="staff-info">
                    <h3>Teache name</h3>
                        <p>English Teacher</p>
                    </div>
                </div>
                <div class="staff-card">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.vgT-xN93AGkhrGpIEaz-sgHaJG&pid=Api&P=0&h=220" alt="David Clark">
                    <div class="staff-info">
                    <h3>Teache name</h3>
                        <p>Physical Education</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
  <?php
  include("../includes/footer.php");
  ?>  
  <?php include("../includes/back-to-top.php");?>
  <script src="assets/js/nav.js"></script>
  <script src="../assets/js/smooth-scroll.js"></script>
</body>
</html>