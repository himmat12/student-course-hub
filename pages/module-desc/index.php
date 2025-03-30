<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module List - Student Course Hub</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Satoshi:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
</head>

<body>
    <?php include('../home/navbar.php'); ?>

    <main class="container">
        <section class="module-header">
            <h1 id="moduleTitle">BSc Data Science</h1>

            <div class="overview-content">
                <h2>Program Overview</h2>
                <div id="overviewContent">
                    <p id="description">Covers big data, machine learning, and statistical computing.</p>
                    <div id="moduleLeader">Dr Ned Stark (Program leader)</div>
                </div>
            </div>
        </section>

        <div class="shared-programs">
            <h2>Shared with Other Programs</h2>

            <div class="program-grid">
                <!-- <div class="program-card">
                    <div class="program-content">
                        <h3 id = "programTitle">BSc Computer Science</h3>
                        <p class="program-lead">Dr. Alice Johnson</p>
                        <p class="program-description">
                            A broad computer science degree covering programming, AI, cybersecurity, and software engineering.
                        </p>
                    </div>
                    <div class="program-action">
                        <button class="btn-register">Register Interest</button>
                    </div>
                </div> -->
            </div>
        </div>
    </main>
    <br>
    <br>

    <?php include('../home/footer.php'); ?>
</body>

</html>