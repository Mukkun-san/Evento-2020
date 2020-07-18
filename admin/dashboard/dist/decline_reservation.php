<?php 

session_start();
include_once "config.php";
$admin = $_SESSION["adminusername"]    ;
$id = $_GET['ResID'];
$sql = "UPDATE confirmations SET `state`='DECLINED', `admin`='$admin'  WHERE id='$id'";
mysqli_query($link,$sql);
header('location: reservations.php');

?>

