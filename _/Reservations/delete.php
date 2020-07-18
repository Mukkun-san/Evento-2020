<?php

if ($_POST) {
    if(isset($_POST["id"]) && !empty($_POST["id"])){
        // Include config file
        require_once "../../config.php";
        echo $id =$_POST["id"];
        // Prepare a delete statement
        $sql = "DELETE FROM forms WHERE id = '$id'; DELETE FROM `confirmations` WHERE id = '$id'
        ";
        if(mysqli_multi_query($link,$sql)){
            header("location: ../../profile.php");
        }
        else{
            echo'Error Occured!';
        }
    } 
    else{
        header("location: ../../profile.php");
        exit;
    }   
      
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
        body{
        }
    </style>
</head>
<body>
<br><br><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header text-center">
                        <h1>Removing Reservation</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in text-center">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <h3>Are you sure you want to delete this reservation?</h3><br>
                            <h4>This Action is irreversible!</h4>
                            <p>
                                <input type="submit" value="Yes" class="btn-lg btn-danger">
                                <a href="../../profile.php" class="btn-lg btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>