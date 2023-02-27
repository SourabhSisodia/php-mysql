<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location:./home.php");
    exit();
}
// get the error message and displays it
if (!empty($_GET['message'])) {
    $message = str_replace("_", " ", $_GET['message']);
    echo "<p style ='color:red; text-align:center;'>$message</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
</head>

<body>
    <form action="./handle_login.php" method="post" style="text-align:center">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>
        <br>
        <label for="password" required>Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <br>

        <p>Not a user <a href="./register.php">Register!!</a></p>
        <button type="submit">Login</button>
    </form>

</body>

</html>