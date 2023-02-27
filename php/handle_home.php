<?php


// connection to database

if (isset($_POST["submit"])) {


    if (
        !isset($_POST['name']) && !isset($_POST['lname']) && !isset($_POST['fileImg']) && !isset($_POST
        ['marks'])
    ) {

        echo " <br/> Please fill in the fields";

    } else {
        $name = $_POST['name'];
        $lname = $_POST['lname'];
        $phone_prefix = $_POST["phone_prefix"];
        $number = $_POST["number"];
        $email = $_POST["email"];
        $phone_number = $phone_prefix . $number;
        $unextracted_marks = explode("\n", $_POST['marks']);




        // getting marks in the format subject=>marks
        foreach ($unextracted_marks as $mark) {
            $pos = strpos($mark, "|");
            $marks[substr($mark, 0, $pos)] = substr($mark, $pos + 1);
        }

        // cocatenate the full name
        $fullName = $name . " " . $lname;




        $data = $_POST;

        // Create the first copy of the data in a doc format
        $server_file = "abc.doc";
        $server_content = "Form Data\n";
        $server_content .= "Name : " . $fullName . "\n";
        $server_content .= "Email : " . $email . "\n";
        $server_content .= "Phone : " . $phone_number . "\n";
        $server_content .= "Subject  Marks" . "\n";
        foreach ($marks as $key => $value) {
            // outputs table row as subject => marks
            $server_content .= "$key  $value" . "\n";
        }
        file_put_contents($server_file, $server_content);

        // Create the second copy of the data in a doc format





        // Check if the file exists
        if (file_exists($server_file)) {
            // Set the headers to trigger a download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($server_file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($server_file));

            // Output the file content
            readfile($server_file);
            exit;
        } else {
            // Handle the error
            echo "The file does not exist.";
        }



    }
}
?>


<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
</head>




</html>