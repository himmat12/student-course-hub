<?php
$title = 'Admin Dashboard';
$name = 'Admin';
?>


<section class="main-section" id="dashboard-section">

    <!-- header section -->
    <?php
    include './components/header.php';
    $title = "Admin Dashboard";
    ?>


    <!-- overview section -->

    <div class="main-content">
        <div class="header-text">Overall Statistics</div>

        <div class="gridview-list">
            <div id="programme-card" class="card"></div>

            <div id="module-card" class="card"></div>

            <div id="staff-card" class="card"></div>

            <div id="student-card" class="card"></div>
        </div>
    </div>
    </div>

</section>