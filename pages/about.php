<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../includes/header-links.php');?>
    <link rel="stylesheet" href="/RMS-Project/assets/css/nav.css">
    <title>About Rukara Model School</title>
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
            /* border-bottom: 5px solid #3498db; */
            text-decoration: underline;
            text-decoration-color: #3498db;
            text-decoration-thickness: 10px;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #2c3e50;
            padding: 10px;
        }

        /* .section-title::after{ */
        /* border-right: 5px solid #3498db;  */
        /* width: 50%; */
        /* } */

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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .staff-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .staff-card img,
        .admin-card img {
            /* border: 1px solid rgb(7, 7, 7); */
            border-bottom: 3px solid #3498db;
            margin-top: 10px;
            width: 50%;
            /* width: fit-content; */
            border-radius: 50%;
            /* height: fit-content; */
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
            <div class="history-card"> Rukara Model School was established as part of the Rwanda Quality Basic Education
                for Human Capital Development (RQBEHCD) project of MINEDUC, a government initiative funded by the World
                Bank after the University of Rwanda-College of Education (UR-CE) submitted a list of
                the priorities intended to improve the quality of education in schools, and also for the training of
                pre-service teachers. <br>

                The list included support to Teachers Training Centres (TTCs), establishment of a
                Demonstration school at UR-Rukara Campus (head office of UR-CE), strengthening the teaching of STEM
                subjects in basic education schools, enhancing English proficiency and digital literacy for TTC and
                UR-CE students. All these priorities were considered with or without modifications to fit the purpose.
                The project aimed to improve teacher training and enhance the quality of education in Rwanda by building
                model schools across the country. The construction of Rukara Model School was completed in 2024, and it
                officially opened its doors for the 2024-2025 academic year.

                <br>Before its establishment, Teacher Training Centers (TTCs) in Rwanda faced several challenges,
                including limited access to practical teaching environments. Many trainee teachers had to rely on
                theoretical coursework without sufficient hands-on experience in real classrooms. Rukara Model School
                was built to address this gap by serving as a demonstration school where student-teachers could gain
                practical teaching experience under the guidance of professional educators.

                <br>The school was designed to reflect modern educational standards, featuring state-of-the-art
                facilities such as fully equipped science laboratories, a digital resource center, and innovative
                teaching spaces. Since its opening, the school has played a key role in developing future educators,
                offering them a space to practice and refine their teaching methods. The integration of ICT in education
                at Rukara Model School has also set a benchmark for other schools in the region, making it a pioneer in
                digital learning.

                <br>Over time, Rukara Model School is expected to continue growing as a center of excellence in teacher
                education, contributing to Rwanda’s broader goals of achieving quality education for all.

                <br>It offers Programmes in the line of General education where we find Nursery Education, Primary
                Education, Ordinary level and Advanced level with options of Mathematics-Economics and Geography (MEG),
                Mathematics-Computer Science and Economics (MCE) and Physics- Chemistry and Mathematics (PCM).

            </div>
        </section>
        <!-- Staff Profiles Section -->
        <section class="staff-section" id="staff">
            <h2 class="section-title">Administration Team</h2>
            <div class="staff-profiles">

                <!-- Update these staff cards -->
                <?php
    $staff_members = [
        ['name' => 'Dr. Barnabas Muyengwa', 'role' => 'Principal', 'image' => '/RMS-Project/assets/images/principal.jpg' ],
        ['name' => 'IYAMUREMYE Eric', 'role' => 'Director of Studies (Secondary)','image' => 'https://th.bing.com/th/id/OIP.GKAbRpYzDlJa139WC8xPtwHaIC?w=178&h=194&c=7&r=0&o=7&dpr=1.5&pid=1.7&rm=3' ],
        ['name' => 'Dr. Mutseekwa Christopher', 'role' => 'Director of Studies (Secondary)','image' => 'https://th.bing.com/th/id/OIP.GKAbRpYzDlJa139WC8xPtwHaIC?w=178&h=194&c=7&r=0&o=7&dpr=1.5&pid=1.7&rm=3' ],
        ['name' => 'Dr. Nyasha Cefas', 'role' => 'Director of Studies (Primary)','image' =>'/RMS-Project/assets/images/DOS-primary_i.jpg' ],
        ['name' => 'Mukamugabo Odette', 'role' => 'Director of Studies (Primary)','image' => 'https://th.bing.com/th/id/OIP.GKAbRpYzDlJa139WC8xPtwHaIC?w=178&h=194&c=7&r=0&o=7&dpr=1.5&pid=1.7&rm=3' ],
        ['name' => 'Nyiransanwa Betty', 'role' => 'Bursar','image' => 'https://th.bing.com/th/id/OIP.GKAbRpYzDlJa139WC8xPtwHaIC?w=178&h=194&c=7&r=0&o=7&dpr=1.5&pid=1.7&rm=3' ],
        ['name' => 'DOD NAME', 'role' => 'Director of Discipline','image' => 'https://th.bing.com/th/id/OIP.GKAbRpYzDlJa139WC8xPtwHaIC?w=178&h=194&c=7&r=0&o=7&dpr=1.5&pid=1.7&rm=3'],
        ['name' => 'Valens', 'role' => 'Secretary','image' => 'https://th.bing.com/th/id/OIP.GKAbRpYzDlJa139WC8xPtwHaIC?w=178&h=194&c=7&r=0&o=7&dpr=1.5&pid=1.7&rm=3']
    ];
    foreach ($staff_members as $staff) {
        echo '<div class="staff-card">
            <img src="'. htmlspecialchars($staff['image']) .'" alt="' . htmlspecialchars($staff['name']) . '">
            <div class="staff-info">
                <h3>' . htmlspecialchars($staff['name']) . '</h3>
                <p>' . htmlspecialchars($staff['role']) . '</p>
            </div>
        </div>';
    }
    ?>
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