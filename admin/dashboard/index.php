<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: ../");
    exit;
}else {
    header("location: dist");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <script language="javascript">
        window.location.href = "dist/index.php"
    </script>
</head>

<body>
    Go to <a href="dist/index.php">/dist/index.php</a>
</body>

</html>
