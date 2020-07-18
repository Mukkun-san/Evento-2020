<?php
session_start();

require_once "../config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username = $_SESSION["username1"];
    $id = $username . '_' . time() ;
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $email = trim($_POST["email"]);
    $identity = trim($_POST["identity"]);
    $format = trim($_POST["format"]);
    $checkin = trim($_POST["checkin"]);
    $checkout = trim($_POST["checkout"]);
    $pack = $_SESSION['PACK'];
  
    if ($pack !== "bronze") {
        $service = trim($_POST["service"]);
    } else {
        $service = "N/A";
    }

    if ($pack == "gold") {
            
        $username = $_SESSION["username1"] ;

        $target_dir = "../uploads/docs/";
        $target_file = $target_dir . basename($_FILES["document"]["name"]);

        $time = time();
        $date = date("Y-m-d h.i.s",$time);

        $org_filename=basename($_FILES["document"]["name"]);   
        $extension = pathinfo($org_filename, PATHINFO_EXTENSION);
        $New_file_Name = $target_dir . $username . " $date ." . $extension ;

        move_uploaded_file($_FILES["document"]["tmp_name"], $New_file_Name);

        $docPath = "_/uploads/docs/" . $username . " $date ." . $extension ;

    }
    else {
        $docPath = "N/A";
    }
    
    $sql = "INSERT INTO forms (id, username, fname, lname, email,
    identity, format, service, checkin, checkout, doc, pack)
    VALUES ('$id', '$username', '$fname', '$lname', '$email',
    '$identity', '$format', '$service', 
    '$checkin', '$checkout', '$docPath', '$pack')";
    
    if($query = mysqli_query($link, $sql)){
        $sql = "INSERT INTO confirmations(id,`state`) VALUES ('$id','N/A')";
        if (mysqli_query($link,$sql) == false ) echo "Error line 64";
       echo '<script>
      window.location.assign("https://evento-project.000webhostapp.com/profile.php")
    </script>' ;
        exit();
    } 
    else{
        echo "Something went wrong. Please try again later. ";
    }

    // Close connection
    mysqli_close($link);
}else{
 echo '<script>
      window.location.assign("https://evento-project.000webhostapp.com")
    </script>' ;   
}

?>