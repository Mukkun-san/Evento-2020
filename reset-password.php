
<?php include '_/common_html/head.php'; ?>
<?php
// Initialize the session
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){

        $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
        $id = $_SESSION["id"];
        
        // Prepare an update statement
        $sql = "UPDATE users SET password = '$hash_password' WHERE id = '$id'";
        
        if($query = mysqli_query($link, $sql)){  
                session_destroy();
                header("location: login.php");
                exit();
        }
        else{
                echo "Oops! Something went wrong. Please try again later.";
            }

        
    }
    
    // Close connection
    mysqli_close($link);
}
?>
    <style>
    body{background:#ccc!important;}
    .help-block{
            color:red!important;
        }
    </style>
    <title>Reset Password</title>
</head>
<body>
    <?php include '_/common_html/nav.php'; ?>
    <br><br><br><br><br>
    <div class="container">
  <div class="row justify-content-md-center">
  <div class="col col-lg-6">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username1"]); ?></b>. You are about to reset your password!</h1>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="profile.php">Cancel</a>
            </div>
        </form>
        </div>
        </div>
        </div>

    <?php include '_/common_html/footer.php'; ?>
</body>
</html>