<?php
// starts the session
session_start();
// checks for session
if (isset($_SESSION["user"])) {
    header("Location:./home.php");
    exit();
}

if (!isset($_GET["email"])) {
    header("Location:./forget_password.php");
    exit();
}
try {
    require_once("connection.php");
} catch (error) {
    header("Location: ./login.php?message=error_in_database");
}
require_once("user.php");
$email = $_GET["email"];
if (isset($_POST["password"])) {
    $password = $_POST["password"];

    $user = new User($email, $password, $conn);
    if ($user->update_password()) {
        header("Location:./login.php");
    } else {
        echo "password not updated try again";
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
</head>

<body>
    <form action=<?php echo "./reset_password.php?email=$email" ?> method="post" style="text-align:center">

        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <br>

        <button type="submit" name="submit">Reset Password</button>
    </form>
</body>

</html>