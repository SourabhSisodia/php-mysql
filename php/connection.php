<?php
$username = "root";
$password = "12Qwerty@";
$db = "user_info";

// Connection
$conn = new mysqli(
    "localhost",
    $username,
    $password,
    $db
);

// For checking if connection is
// successful or not
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}

?>