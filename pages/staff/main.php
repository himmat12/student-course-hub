<?php
$title = 'Staff Dashboard';
$name = 'Staff';
?>


<section class="main-section" id="dashboard-section">

    <!-- header section -->
    <?php
    include './components/header.php';
    $title = "Staff Dashboard";
    ?>


    <!-- overview section -->

    <div class="main-content">
        <div class="header-text">Overview</div>

        <div class="gridview-list">
            <div id="programme-card" class="card"></div>

            <div id="module-card" class="card"></div>

            <div id="staff-card" class="card"></div>

            <div id="student-card" class="card"></div>
        </div>
    </div>
    </div>

</section>