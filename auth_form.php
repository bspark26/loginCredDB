<?php
$host = "localhost";
$database = "assignment2db";
$password = "";
$username = "root";

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check for form submission
if (isset($_POST['register'])) {
    // Escape special characters
    $userName = mysqli_real_escape_string($conn, $_POST['userName']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $query = "INSERT INTO logincreds (userName, password) VALUES ('$userName', '$password')";
    mysqli_query($conn, $query);

    echo "You have successfully registered!";
}

if (isset($_POST['login'])) {
    // Escape special characters
    $userName = mysqli_real_escape_string($conn, $_POST['userName']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Get the user from the database
    $query = "SELECT * FROM logincreds WHERE userName = '$userName'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // Verify the password
    if (password_verify($password, $user['password'])) {
        echo "Welcome, " . $user['userName'] . "!";
    } else {
        echo "Incorrect username or password.";
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma-rtl.min.css">
    <title>Registration and Login</title>
</head>

<body>
    <section id="container" class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="column has-text-centered">
                    <div class="box">
                        <h1 class="is-size-3">Registration</h1>
                        <form method="post">
                            <label for="userName">Username:</label>
                            <input class="input is-primary" type="text" name="userName" id="username">
                            <br>
                            <label for="password">Password:</label>
                            <input class= "input is-primary" type="password" name="password" id="password">
                            <br>
                            <input class= "button is-info" type="submit" name="register" value="Register">
                        </form>
                    </div>
                    <div class="box">
                        <h1 class="is-size-3">Login</h1>
                        <form method="post">
                            <label for="userName">Username:</label>
                            <input class="input is-success" type="text" name="userName" id="username">
                            <br>
                            <label for="password">Password:</label>
                            <input class= "input is-success" type="password" name="password" id="password">
                            <br>
                            <input class= "button is-success" type="submit" name="login" value="Login">
                        </form>
                    </div>
                </div>
            </div>
    </section>






</body>

</html>