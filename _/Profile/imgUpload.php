<?php 

    session_start();

    include_once '../config.php';
    $username = $_SESSION["username1"] ;

    if (isset($_POST['imgsubmit'])){

        // IF NO FILE WAS UPLOADED RETURN TO PROFILE PAGE
        if (basename($_FILES["profileimg"]["name"])=="") {
            $_SESSION['ppic_State']= FALSE;
            header('location: ../../profile.php');
            exit;
        }

        $_SESSION['ppic_State']= TRUE;
        $target_dir = "../uploads/images/";
        $target_file = $target_dir . basename($_FILES["profileimg"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $org_filename=basename($_FILES["profileimg"]["name"]);   
        $ext = pathinfo($org_filename, PATHINFO_EXTENSION);
        $target_file = $target_dir . $username . '.' . $ext ;

        move_uploaded_file($_FILES["profileimg"]["tmp_name"], $target_file);

        $full_path = '_/'.substr($target_file,3);

        // ADD PICTURE PATH TO DATABASE 
        $sql = "UPDATE users SET profileimg='$full_path' WHERE username='$username'";
        $result = mysqli_query($link, $sql);

        header('location: ../../profile.php');

    }

    if (isset($_POST['imgdel'])){

        // DELETE PROFILE IMAGE FROM SERVER FOLDER
        unlink(ltrim("../../".$_SESSION['profileImg'],"_/"));

        // ADD EMPTY PROFILE IMAGE LINK TO THE DATABASE
        $sql = "UPDATE users SET profileimg='http://ssl.gstatic.com/accounts/ui/avatar_2x.png' WHERE username='$username'";
        mysqli_query($link, $sql);
        header("location: ../../profile.php");
    }

    header("location: ../../profile.php");
    
?>