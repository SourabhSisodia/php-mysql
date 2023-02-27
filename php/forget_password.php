<?php

// starts the session
session_start();
// checks for session
if (isset($_SESSION["user"])) {
    header("Location:./home.php");
    exit();
}
try {
    require_once("connection.php");
} catch (error) {
    header("Location: ./login.php?message=error_in_database");
}
require_once("user.php");
// get the error message and displays it
if (!empty($_GET['message'])) {
    $message = str_replace("_", " ", $_GET['message']);
    echo "<p style ='color:red; text-align:center;'>$message</p>";
}



if (isset($_POST["submit"])) {

    $email = $_POST["email"];

    $user = new User($email, "123", $conn);
    if ($user->user_exists()) {
        if ($user->sent_mail()) {
            echo "<p style ='color:green; text-align:center;'>Mail Sent Successfully</p>";
        } else {
            echo "<p style ='color:red; text-align:center;'>Error in sending mail please try again</p>";
        }

    } else {
        header("Location: ./forget_password.php?message=user_does_not_exists_please_register");
        exit();

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forget Password</title>
</head>

<body>
    <form action="./forget_password.php" method="post" style="text-align:center">
        <h1>Forget Password</h1>
        <label for="email">User Email to get link for forget password:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <br>

        <button type="submit" name="submit">Get Link</button>
    </form>

</body>

</html>