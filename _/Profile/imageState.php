<?php

// GET Profile picture PATH from DATABASE AND STORE IN SESSION variable
$uname=$_SESSION['username1'];
$sql = "SELECT profileimg FROM users WHERE username='$uname'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$_SESSION['profileImg'] = $row["profileimg"];

//---------------------------------------------------------------------

// IF USER CLICKED UPLOAD WITHOUT CHOOSING AN IMAGE DISPLAY AN ALERT BOX
if(isset($_SESSION['ppic_State'])){
    if ($_SESSION['ppic_State'] == FALSE) {
        $_SESSION['ppic_State']= TRUE;
        echo "<script>alert('No Image Was Uploaded!')</script>";
    }
}

?>