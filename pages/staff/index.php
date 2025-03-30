<?php
$title = "Staff Dashboard";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="./styles.css">
    <script src="script.js" defer></script>
</head>

<body>

    <div class="main-wrapper">
        <!-- sidebar navigation section -->

        <?php
        include './components/sidebar.php';
        ?>

        <!-- main content -->

        <main class="main-content">
            <?php
            include './main.php';
            ?>
        </main>
    </div>
</body>

</html>