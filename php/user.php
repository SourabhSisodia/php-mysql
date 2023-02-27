<?php
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

}

?>