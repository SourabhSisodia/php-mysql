<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../vendor/autoload.php');
class User
{
  private $email;
  private $password;
  private $conn;
  function __construct($email, $password, $conn)
  {
    $this->email = $email;
    $this->password = $password;
    $this->conn = $conn;
  }
  public function user_exists()
  {
    try {
      $sql = "select Email from  user_data where Email='$this->email';";
      $result = mysqli_query($this->conn, $sql);

    } catch (error) {
      exit;
    }
    if ($result->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function create_user()
  {
    $sql = "INSERT INTO user_data VALUES ('$this->email','$this->password');";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      return true;
    } else {
      false;
    }


  }
  public function check_password()
  {
    // try querying sql database if successful perform operations else redirect
    try {
      $sql = "SELECT `Email`, `Password` FROM `user_data` WHERE `Email`='$this->email';";
      $result = mysqli_query($this->conn, $sql);
    } catch (error) {
      return false;

    }


    $row = $result->fetch_assoc();

    // checks if password is correct or not
    if ($this->password != $row["Password"]) {
      return false;


    } else {
      // sets the user variable in session and redirects to welcome page
      $_SESSION["user"] = $this->email;
      return true;

    }



  }
  public function sent_mail()
  {
    try {

      $mail = new PHPMailer(true);
      $mail->SMTPDebug = 0; //Enable verbose debug output
      $mail->isSMTP(); //Send using SMTP
      $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
      $mail->SMTPAuth = true; //Enable SMTP authentication
      $mail->Username = 'ssdespacito2@gmail.com'; //SMTP username
      $mail->Password = 'jczouhropxahejbl'; //SMTP password
      $mail->SMTPSecure = 'ssl'; //Enable implicit TLS encryption
      $mail->Port = 465;


      $mail->setFrom('ssdespacito2@gmail.com');
      $mail->addAddress($this->email, 'Joe User');
      $mail->isHTML(true); //Set email format to HTML
      $mail->Subject = 'Here is the subject';
      $body = "Click on this link to reset password-- http://localhost/php-mysql-advance/php/reset_password.php?email=$this->email";
      $mail->Body = $body;
      $mail->AltBody = $body;

      $mail->send();

      return true;
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      return false;
    }
  }
  public function update_password()
  {
    $sql = "UPDATE user_data SET Password ='$this->password' WHERE Email='$this->email'";

    if (mysqli_query($this->conn, $sql)) {
      echo "Record updated successfully";
      return true;
    } else {
      echo "Error updating record: " . mysqli_error($this->conn);
      return false;
    }

  }

}

?>