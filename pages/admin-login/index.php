<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/web-project-the-a-team/css/styles.css">

    <script src="script.js" defer></script>
</head>

<body>
    <div class="error-message"></div>
    <div class="login-container">
        <h2>STUDENT COURSE HUB</h2>
        <h4>Sign in to access your account</h4>
        <form>
            <div class="field-wrapper">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Username" name="username">

                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" name="password">
            </div>



            <button class="login-btn" type="submit">Login</button>
            <p><a href="#">Forgot Password?</a></p>
        </form>
    </div>


</body>

</html>