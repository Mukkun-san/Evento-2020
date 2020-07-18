<?php

include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name=trim($_POST['name']);
        $email=trim($_POST['email']);
        $phone=trim($_POST['phone']);
        $message=trim($_POST['message']);
        $sql = "INSERT INTO contact (`name`, phone, email,`message`) 
            VALUES ('$name', '$phone', '$email', '$message') ";
        
        if (mysqli_query($link,$sql)){
            header('location: ../index.php');
            exit;
        }
        else {
            echo 'Error';
        }
    
}
else {
        header('location: ../index.php');
        exit;
}

?>