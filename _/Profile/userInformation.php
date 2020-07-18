<?php
 $id = $_SESSION["id"] ;

if (isset($_POST['Submit_userInfo'])) {

    // insert form data into variables
    $ufname = trim($_POST['ufname']);
    $ulname = trim($_POST['ulname']);
    $uage = trim($_POST['uage']);
    $uemail = trim($_POST['uemail']);
    $uphone = trim($_POST['uphone']);
    $uaddress = trim($_POST['uaddress']);
    $ucity = trim($_POST['ucity']);
    $ugender = trim($_POST['ugender']);

    //check if user submitted information before
    $sql="SELECT * FROM `userinfo` WHERE userid='$id'";
    $query = mysqli_query($link,$sql);

    // if there is no information in the database 
    // insert new row in the userinfo table
    if (mysqli_num_rows($query) == 0) { 
        $sql="INSERT INTO `userinfo`(`userid`, `fname`, `lname`, `age`, `email`, `phone`, `address`, `city`, `gender`) VALUES ( '$id', '$ufname', '$ulname', '$uage', '$uemail', '$uphone', '$uaddress', '$ucity', '$ugender')";
        if(($query = mysqli_query($link,$sql))==false){
            echo "query has failed";
        }
    }    
    // UPDATE EXISTING USER INFO 
    else{ 
        $info = array("fname"=>$ufname, "lname"=>$ulname, "age"=>$uage, "email"=>$uemail, "phone"=>$uphone, "address"=>$uaddress, "city"=>$ucity, "gender"=>$ugender);
        foreach ($info as $key => $value) {
            if ($value != "") {
                $sql="UPDATE `userinfo` SET `$key`='$value' WHERE userid='$id'";
                $query = mysqli_query($link,$sql);
            }
        }
    }
}

// Delete User Information button was clicked
if (isset($_POST['Delete_userInfo'])) {
    $sql="DELETE FROM `userinfo` WHERE userid = '$id' ";
    $res = mysqli_query($link,$sql) ;
}

$fName = $lName = $Email = $Gender = $Age = $Phone =  $Address =  $City = "--" ;
$sql = "SELECT * from userinfo WHERE userid='$id'";
$res = mysqli_query($link,$sql);
if(mysqli_num_rows($res) == 1){
    // assoc array containing user information
    $row = mysqli_fetch_assoc($res);

    // Put user information in variables or insert "--" if empty ;
    if (!empty($row['fname']))      { $fName = $row['fname']  ; }
    if (!empty($row['lname']))      { $lName = $row['lname']  ; }
    if (!empty($row['gender']))     { $Gender = $row['gender']  ; }
    if (!empty($row['age']))        { $Age = $row['age']  ; }
    if (!empty($row['email']))      { $Email = $row['email']  ; }
    if (!empty($row['phone']))      { $Phone = $row['phone']  ; }
    if (!empty($row['address']))    { $Address = $row['address']  ; }
    if (!empty($row['city']))       { $City = $row['city']  ; }
}

