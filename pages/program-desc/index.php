<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSc Computer Science</title>
    <link rel="stylesheet" href="style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
</head>

<body>
    <?php include('../home/navbar.php'); ?>

    <main class="container">
        <section class="course-intro">
            <div class="course-header">
                <h1 id="title"></h1>
                <p id="level" class="level"></p>
            </div>

            <div class="course-description">
                <h2>Program Overview</h2>
                <p id="description"></p>

                <div class="program-details">
                    <p id="programLeader"></p>
                    <button class="register-button">Register Interest</button>
                </div>
            </div>
        </section>

        <section class="curriculum">
            <h2>Curriculum Breakdown</h2>

            <div class="curriculum-years">
                <div class="year-block">
                    <h3>Year 1</h3>
                    <div id="year1-modules">
                        
                    </div>
                </div>

                <div class="year-block">
                    <h3>Year 2</h3>
                    <div id="year2-modules">
                        
                    </div>
                </div>

                <div class="year-block">
                    <h3>Year 3</h3>
                    <div id="year3-modules">
                        
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php include('../home/footer.php'); ?>
</body>

</html>