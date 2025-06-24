<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../includes/header-links.php');?>
    <link rel="stylesheet" href="/RMS-Project/assets/css/nav.css">
    <title>About Rukara Model School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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
            z-index: -1;
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
           width: 100%;
    max-width: 300px;
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s;
    margin: 10px auto;
    text-align: center;
    position: relative;
        }

        .staff-card img,
        .admin-card img {
            /* border: 1px solid rgb(7, 7, 7); */
            border-bottom: 3px solid #3498db;
            margin-top: 10px;
            width: 50%;
            /* width: fit-content; */
            border-radius: 50%;
          height: auto;
            object-fit: cover;
        }

        .staff-info {
            padding: 1rem;
        }
        .staff-info h3 {
    margin: 10px 0 5px;
    font-size: 20px;
}
.staff-info .role {
    color: #555;
    font-weight: bold;
}
.staff-info .description {
    font-size: 14px;
    color: #666;
    margin: 10px 0;
}
.social-links {
    opacity: 0;
    visibility: hidden;
    transition: 0.3s ease;
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}
.social-links a {
    color: #444;
    font-size: 16px;
    transition: color 0.3s;
}

.social-links a:hover {
    color: #0077b5; /* Example hover color */
}
/* Show icons on hover */
.staff-card:hover .social-links {
    opacity: 1;
    visibility: visible;
} 
@media screen and (max-width: 600px) {
    .staff-card {
        max-width: 90%;
    }
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
        .about-link:visited{
            color:rgb(219, 52, 99);
        }
         .about-link:link{
            color:magenta;
        }
        .about-link:active{
            color: #3498db;
        }
    </style>
</head>
<body>
    <?php include("../includes/navigation.php"); ?>

    <main class="about-container">
        <!-- School History Section -->
        <section class="history-section" id="history">
            <h2 class="section-title">Our School History</h2>
            <div class="history-card"> Rukara Model School was established as part of the <a class="about-link" href="https://ce.ur.ac.rw/RQBEHCD/" target="_blank">Rwanda Quality Basic Education
                for Human Capital Development</a> project of MINEDUC, a government initiative funded by the World
                Bank after the University of Rwanda-College of Education (UR-CE) submitted a list of
                the priorities intended to improve the quality of education in schools, and also for the training of
                pre-service teachers. <br>
                <!-- 
                Partners
                1. Mineduc
                2. World Bank
                3. Kayonza District
                4. Nesa
                5. Idebate
                6. International Lab Schools
                7. MINICT
                 -->
                <!-- 
                For students
                1. English proficiency
                2. Stem Program
                3. Uploading their works
                -->
                <!-- 
                For teacher
                1. CPD sessions
                2. Notes and exercises to be accessed by students
                3. Test Safe Browser 
                4. Teacher can upload past papers
                 -->
                <!-- 
                 Interns  should be recorded in the school system
                  -->

                  <!-- 
                  The strategic plan, School Improvement plan and Action plan should be added on home page
                   -->
                  <!-- 
                   Program Remedial and Inclusion program shoul be in Events tab -->
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

               
            </div>
        </section>
        <!-- Staff Profiles Section -->
        <section class="staff-section" id="staff">
            <h2 class="section-title">Administration Team</h2>
            <div class="staff-profiles">

                <!-- Update these staff cards -->
                <?php
    $staff_members = [
        ['name' => 'Dr. Barnabas Muyengwa', 'role' => 'Principal', 'image' => '/RMS-Project/assets/images/principal.jpg', 'contact'=>'09876543','twitter'=>'' , 'linkedin'=>'', 'description'=> 'Dr. Barnabas Muyengwa is an experienced educator passionate about lifelong learning. With a rich background in teacher development, he values mentoring in teacher professional growth and has widely published on the subject.' ],
        ['name' => 'IYAMUREMYE Eric', 'role' => 'Director of Studies (Secondary)','image' => '/RMS-Project/assets/images/eric.png', 'contact'=>'','twitter'=>'' , 'linkedin'=>'', 'description'=>'' ],
        ['name' => 'Dr. Mutseekwa Christopher', 'role' => 'Director of Studies (Secondary)','image' => '/RMS-Project/assets/images/dos-chistoph.png', 'contact'=>'','twitter'=>'' , 'linkedin'=>'', 'description'=>'' ],
        ['name' => 'Dr. Nyasha Cefas', 'role' => 'Director of Studies (Primary)','image' =>'/RMS-Project/assets/images/DOS-primary_i.jpg','contact'=>'','twitter'=>'' , 'linkedin'=>'', 'description'=>'' ],
        ['name' => 'Mukamugabo Odette', 'role' => 'Director of Studies (Primary)','image' => '/RMS-Project/assets/images/dos-primary-ii.png','contact'=>'','twitter'=>'' , 'linkedin'=>'', 'description'=>'' ],
        ['name' => 'Nyiransanwa Betty', 'role' => 'Bursar','image' => '/RMS-Project/assets/images/bursar.jpg','contact'=>'','twitter'=>'' , 'linkedin'=>'', 'description'=>'' ],
        ['name' => 'Justine Mukarugira', 'role' => 'Director of Discipline','image' => '/RMS-Project/assets/images/dod2.png','contact'=>'','twitter'=>'' , 'linkedin'=>'', 'description'=>''],
        ['name' => 'Niyonsenga Valens', 'role' => 'Secretary','image' => '/RMS-Project/assets/images/secretary.png','contact'=>'','twitter'=>'' , 'linkedin'=>'', 'description'=>'' ], 
    ];
    foreach ($staff_members as $staff) {
        echo '
<div class="staff-card">
    <img src="' . htmlspecialchars($staff['image']) . '" alt="' . htmlspecialchars($staff['name']) . '">
    <div class="staff-info">
        <h3>' . htmlspecialchars($staff['name']) . '</h3>
        <p class="role">' . htmlspecialchars($staff['role']) . '</p>
        <p class="description">' . htmlspecialchars($staff['description']) . '</p>
        <div class="social-links">
            <a href="tel:+25' . htmlspecialchars($staff['contact']) . '" title="Call "' . htmlspecialchars($staff['name']) . '" target="_blank"><i class="bi bi-telephone-fill"></i>
</a>
            <a href="' . htmlspecialchars($staff['twitter']) . '" title="Twitter "' . htmlspecialchars($staff['name']) . ' on Twitter" target="_blank"><i class="fab fa-twitter"></i></a>
            <a title="LinkedIn "' . htmlspecialchars($staff['name']) . '" href="' . htmlspecialchars($staff['linkedin']) . '" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
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