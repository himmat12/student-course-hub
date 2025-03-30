<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Interest</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Satoshi:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
</head>

<body>
    <!-- Navbar -->
    <?php include('../home/navbar.php'); ?>


    <!-- Main Content -->


    <section class="course-info-wrapper">
        <div class="course-info">
            <h2 id="title"></h2>
            <div class="course-item" id="level"></div>
            <div class="course-item" id="programLeader"></div>
            <div class="course-item" id="description"></div>
        </div>
    </section>

    <div class="error-msg-wapper">
        <div class="message-box"></div>
    </div>

    <div class="form-wrapper">
        <form id="registerForm">
            <h1 id="form-header">Regitster Your Interest</h1>
            <label for="fullName">Full Name:</label>
            <input class="form-field" type="text" id="fullName" name="fullName" required>
            <p id="fullNameError"></p>

            <label for="email">Email Address:</label>
            <input class="form-field" type="email" id="email" name="email" required>
            <p id="emailError"></p>

            <!-- Hidden field for program ID -->
            <input class="form-field" type="hidden" id="programmeID" name="programmeID" value="1">

            <div class="checkboxes">
                <label>
                    <input type="checkbox" id="terms" name="terms" required> I agree to the Terms & Conditions
                </label>
                <p id="termsError"></p>

            </div>

            <button id="registerBtn">Submit</button>
        </form>

    </div>
    <!-- </div> -->

    <!-- footer -->
    <?php include('../home/footer.php'); ?>

</body>

</html>