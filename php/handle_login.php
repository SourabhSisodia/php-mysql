<?php
// starts the session
session_start();

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
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];



    $user = new User($email, $password, $conn);

    if ($user->user_exists()) {
        if ($user->check_password()) {
            // $_SESSION["user"] = $email;
            header("Location: ./home.php");
        } else {
            header("Location: ./login.php?message=wrong_password!!");
        }
        exit();

    } else {
        header("Location: ./login.php?message=user_does_not_exists_please_register");
        exit();

    }

} else {
    header("Location:./register.php?please_fill_all_the_fields");
}


?>