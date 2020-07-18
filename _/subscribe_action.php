<?php

include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email=trim($_POST['subemail']);
        $current_time = time();
        $current_date=date("Y-m-d h-m-s",$current_time);

        $sql = "INSERT INTO subs (email,`date`) 
            VALUES ('$email','$current_date') ";
        
        if (mysqli_query($link,$sql)){
            header('location: ../index.php');
            exit;
        }
        else {
            echo 'Error Happened';
        }

}
else {
        header('location: ../index.php');
        exit;
}

?>