<!DOCTYPE html>
<html lang="en">
<base href="/web-project-the-a-team/">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Course Hub</title>
    <link rel="stylesheet" href="pages/home/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Satoshi:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        crossorigin="anonymous"></script>

    <script src="/web-project-the-a-team/pages/home/script.js" defer></script>
</head>

<body>
    <!-- nav bar (header) -->


    <?php

    include('navbar.php');

    ?>


    <?php include('search.php'); ?>


    <section class="banner-container">
        <div class="bg-img">
            <img src="/web-project-the-a-team/pages/home/image/zey.jpg" alt="Historic redbrick university buildings reflect in a tranquil pond at dusk. 
                                                                            Bare winter trees frame the scene, with a streetlamp beside manicured lawns 
                                                                            and Tudor-style architectural elements catching the golden late afternoon light">
        </div>
        <div class="bg-overlay">
            <h1>Welcome to Student Hub</h1>
            <p>Empowering minds, shaping futures. Join our community of scholars and innovators.</p>
            <div class="banner-buttons">
                <a onclick="localStorage.setItem('selectedProgram', 'all')" href="/web-project-the-a-team/pages/pragram-page" class="btn explore-btn">Explore Programmes</a>
            </div>
        </div>
    </section>


    <!-- Program Categories Section -->
    <section class="program-categories">
        <div class="category-box" id="ugProgram">
            <img src="pages/home/image/undergraduate.jpg" alt="Three students sit on grassy ground beneath a tree.
                                                              A smiling woman in a red top with curly hair holds a notebook, while two men chat with her, 
                                                              one wearing glasses and another with a laptop nearby">

            <div class="overlay-text">
                <h2>Undergraduate Programmes </h2>

            </div>
        </div>
        <div class="category-box" id="pgProgram">
            <img src="pages/home/image/postgraduate.jpg" alt="Modern office workspace with five people working at a shared table. 
                                                              Employees use computers, laptops, and tablets, with a small cactus and wire basket visible.
                                                              Large windows and collaborative work environment">


            <div class="overlay-text">
                <h2>Postgraduate Programmes</h2>

            </div>
        </div>
    </section>



    <!-- news and events sections -->
    <section class="news-events">
        <h2>News and Events</h2>
        <div class="news-container">
            <div class="news-item">
                <h3><a href="#">AI in Education</a></h3>
                <p>Discover how artificial intelligence is transforming online learning platforms.</p>
            </div>
            <div class="news-item">
                <h3><a href="#">New Library Opens</a></h3>
                <p>The university unveils its state-of-the-art library with digital and research facilities.</p>
            </div>
            <div class="news-item">
                <h3><a href="#">Student Innovation Fair</a></h3>
                <p>Join us at the annual fair where students showcase groundbreaking research and projects.</p>
            </div>
            <div class="news-item">
                <h3><a href="#">Sustainability Week</a></h3>
                <p>A week-long event featuring talks and workshops on eco-friendly campus initiatives.</p>
            </div>
            <div class="news-item">
                <h3><a href="#">Internship Opportunities</a></h3>
                <p>New partnerships with tech firms open doors for students seeking internships.</p>
            </div>
            <div class="news-item">
                <h3><a href="#">Global Exchange Program</a></h3>
                <p>Applications open for students wishing to study abroad in top-ranked universities.</p>
            </div>
        </div>
    </section>

    <!-- Awards Section -->
    <section class="awards-section">
        <h2>Our Achievements</h2>
        <div class="awards-container">
            <div class="award-box">
                <img src="pages/home/image/award1.jpg" alt="TEF 2023 Silver award logo for Teaching Excellence Framework, featuring stylized blue and white graphic design with large text">
                <h3>Best Innovation Award</h3>
                <p>Recognized for excellence in educational technology innovation.</p>
            </div>
            <div class="award-box">
                <img src="pages/home/image/award2.jpg" alt="REF 2021 Research Excellence Framework logo with orange 'REF' text and grey year and descriptive text.">
                <h3>Research Excellence</h3>
                <p>Awarded for groundbreaking contributions to scientific research.</p>
            </div>
            <div class="award-box">
                <img src="pages/home/image/award3.jpg" alt="NSS National Student Survey logo, with large white 'NSS' letters in a purple speech bubble shape on a bright yellow background.">
                <h3>Community Impact Award</h3>
                <p>Honored for making a positive difference in local and global communities.</p>
            </div>
            <div class="award-box">
                <img src="pages/home/image/award4.jpg" alt="THE World University Rankings logo, with 'THE' in white letters on a rounded square gradient background transitioning from red to purple to blue.">
                <h3> Top University Recognition</h3>
                <p>Ranked among the top institutions globally for academic excellence.</p>
            </div>
        </div>
    </section>






    <?php

    include('footer.php');

    ?>


</body>

</html>