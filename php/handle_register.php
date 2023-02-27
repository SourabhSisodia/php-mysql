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
    header("Location: ./register.php?message=error_in_database");
}

require_once("user.php");
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["again_password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_1 = $_POST["again_password"];

    // check for password
    if ($password != $password_1) {
        header("Location: ./register.php?message=password_did_not_match");
        exit();
    }
    $user = new User($email, $password, $conn);
    $user->user_exists();
    if ($user->user_exists()) {
        header("Location: ./register.php?message=user_already_exists_please_login");
        exit();
    } else {
        $user->create_user();
        if ($user->create_user()) {
            # code...
            header("Location: ./login.php?message=user_created_successfully_now_you_can_login");
        } else {
            header("Location: ./register.php?message=user_not_created_try_again");
        }
        exit();
    }

} else {
    header("Location:./register.php?please_fill_all_the_fields");
}

?>