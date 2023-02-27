<?php
// starts the session
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
    <title>Welcome Page!!</title>
</head>

<body>
    <form action="./handle_register.php" method="post" style="text-align:center">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>
        <br>
        <label for="password" required>Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <br>
        <label for="again-password" required>Re Type Password:</label>
        <input type="password" name="again_password" id="again-password">
        <br>
        <br>
        <p>Already a user <a href="./login.php">Login!!</a></p>
        <button type="submit">Register</button>
    </form>
</body>

</html>