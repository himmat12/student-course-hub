<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
</head>

<body>
    <h1>404 page not found</h1>
    <button onclick="redirectToHome();">Go to home page</button>
</body>

<script>
    const BASE_URL = `http://localhost/web-project-the-a-team`;
    // const BASE_URL = `http://localhost:6789/web-project-the-a-team`;
    function redirectToHome() {
        window.location.replace(BASE_URL);
    }
</script>

</html>