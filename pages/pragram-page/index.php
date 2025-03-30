<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undergraduate Programs</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
</head>

<body>
    <!-- Header -->
    <?php include('../home/navbar.php'); ?>

    <!-- Search Section -->
    <section>
        <base href="/web-project-the-a-team/">
        <div class="search-container">
            <h4 class="search-tab active">Search for a Course</h4>
            <div class="search-fields">
                <form id="searchForm" class="search-form">
                    <input id="searchField" type="text" name="query" placeholder="Search by program name...">
                    <select name="program-lvl" id="programLevel">
                        <option value="">All Levels</option>
                        <option value="1">Undergraduate</option>
                        <option value="2">Postgraduate</option>
                    </select>

                    <button class="search-button">🔍 Search</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Course List -->
    <section class="course-list">
        <!-- <div id="programmesHeader"></div> -->
        <div id="programmesHeaderTitle">Explore Programmes</div>
        <div class="course-container">

        </div>
    </section>

    <!-- Pagination -->
    <!-- <div class="pagination">
        <a href="#" class="prev">Previous</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#" class="next">Next</a>
    </div> -->

    <!-- footer -->
    <?php include('../home/footer.php'); ?>



</body>

</html>