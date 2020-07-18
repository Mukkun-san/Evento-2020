<?php
  include 'login/login_system.php';


 include '_/common_html/head.php'; 
 
    // Check if the user is already logged in, 
    // if yes then redirect him to profile page 
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
      
        echo '
            
            <script>
              window.location.assign("https://evento-project.000webhostapp.com/profile.php")
            </script>

' ;
      
      exit;
    }
?>


    <!-- custom-theme -->
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, minimum-scale=1"
    />
    <link
      rel="shortcut icon"
      href="assets/images/93670627-571269746842714-5752841786544357376-n-195x129.png"
      type="image/x-icon"
    />

    <link
      href="login/css/style.css"
      rel="stylesheet"
      type="text/css"
      media="all"
    />
    <script src="login/js/jquery-1.9.1.min.js"></script>
    <link
      rel="stylesheet"
      type="text/css"
      href="login/css/easy-responsive-tabs.css "
    />
    <link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet" />
    <title>Log In</title>
  </head>
  <body>
<?php include '_/common_html/nav.php'; ?>
<style>
  form span{
    color:red;
  }
</style>
<hr style="height:1px;">
    <section class="engine">
      <a href="https://mobirise.info/v">free html templates</a>
    </section>
    <section class="header1 cid-rWxKHTv9t8" id="header16-4y">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-10 align-center">
            <p class="mbr-text pb-3 mbr-fonts-style display-5"></p>
          </div>
        </div>
      </div>
    </section>
    <div class="w3layouts_main wrap w-75">
      <!--Horizontal Tab-->
      <div id="parentHorizontalTab_agile">
        <ul class="resp-tabs-list hor_1">
          <li>LogIn</li>
          <li>SignUp</li>
        </ul>
        <div class="resp-tabs-container hor_1">
          <div class="w3_agile_login">
 
<!--  BEGINNING OF FORM   -->

          <form action="login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username1" class="form-control" >
                <span><?php echo $username_error1; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password1" class="form-control">
                <span><?php echo $password_error1; ?></span>
            </div>
            <div class="form-group">
                <input type='hidden' name='Activity' value='login' />
                <input type="submit" class="btn btn-primary w-50" value="Login" style="width:250px;color:#000!important;">
            </div>
            
        </form>
          </div>
          <div class="agile_its_registration">
          <form action="login.php#parentHorizontalTab_agile2" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" >
                <span> <?php echo $username_error; ?> </span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span><?php echo $password_error; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span><?php echo $confirm_password_error; ?></span>
            </div>
            <input type='hidden' name='Activity' value='signup' />
            <div class="form-group ">
                <input type="submit" class="btn btn-default w-50" value="Submit" 
                 style="width:250px;color:#000;background-color:#fff;">
            </div>
        </form>
          </div>
        </div>
      </div>
      <!-- //Horizontal Tab -->
    </div>

<?php include '_/common_html/footer.php'; ?>

    <!-- login signup scripts -->
    <script src="login/js/easyResponsiveTabs.js"></script>
    <script src="login/js/switch_login_signup.js"></script>

  </body>
</html>
