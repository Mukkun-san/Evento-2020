<?php

  require "config.php";

  // initialize ERROR variables with empty strings
  $username_error = $password_error = $confirm_password_error = "";
  $username_error1 = $password_error1 = "";

  // Define INPUT variables and initialize with empty values
  $username1 = $password1 = ""; 
  $username = $password = $confirm_password = "";


  if ($_SERVER["REQUEST_METHOD"] != "POST"){ 
      // if there is no POST request do nothing and display html
  }
  else{ // IN CASE OF SUMBISSON
    
      if (($_POST['Activity'] == 'login')){ // login form submitted
    
          // Check if username is empty
          if(empty(trim($_POST["username1"]))){
              $username_error1 = "Please enter username.";
          } else{
              $username1 = trim($_POST["username1"]);
          }
          
          // Check if password is empty
          if(empty(trim($_POST["password1"])) && empty($username_error1)){
              $password_error1 = "Please enter your password.";
          } else{
              $password1 = trim($_POST["password1"]);
          }
          
          // Validate Username + Password
          if(empty($username_error1) && empty($password_error1)){

              // Check if username exist in database
              $sql = "SELECT * FROM users WHERE username = '$username1'";
              
              if($query = mysqli_query($link, $sql)){
                
                // if username exists then verify password
                if(mysqli_num_rows($query) == 1){  
                  $row = mysqli_fetch_assoc($query);
                  $hashed_password = $row['password'];
                  if(password_verify($password1, $hashed_password)){
                      // Password is correct, so start a new session
                      session_start();
                      
                      // Store data in session array
                      $_SESSION["loggedin"] = true;
                      $_SESSION["id"] = $row['id'];
                      $_SESSION["username1"] = $username1;                            

                      // Redirect user to profile page

        /*            echo '
                    
                    <script>
                      window.location.assign("https://evento-project.000webhostapp.com/profile.php")
                    </script>
                    
                    ' ;    */
                  } 
                  else{
                      // Error if password is not correct
                      $password_error1 = "Password Incorrect.";
                  }
                }
                else{
                    // Display an error message if username doesn't exist
                    $username_error1 = "No account found with that username.";
                  }
              }
              else{
                  echo "Oops! Something went wrong. Please try again later.";
              }
          }
          
      }

      else {  // SIGNUP form is submitted
         
             // Validate username
             if(empty(trim($_POST["username"]))){  //username empty 
                 $username_error = "Please enter a username.";
             } 
             elseif (strlen(trim($_POST["username"])) < 4) {
                $username_error = "Username must have at least 4 characters.";
             }
             else{ //username not empty and > 4 characters
                 $current_username = $_POST["username"] ;
                 // check if username exists in database
                 $sql = "SELECT * FROM users WHERE username = '$current_username' ";
                 
                 if($query = mysqli_query($link, $sql)){

                      if(mysqli_num_rows($query) == 1){ //username exists in database
                          $username_error = "This username is already taken.";
                      } 
                      else{ 
                          $username = trim($_POST["username"]);
                      }
                 } 
                 else{
                    echo "Oops! Something went wrong. Please try again later.";
                 }
       
                 
             }
             
             // Validate password
             if(empty(trim($_POST["password"])) && empty($username_error)){
                 $password_error = "Please enter a password.";     
             }
             elseif(strlen(trim($_POST["password"])) < 6 && empty($username_error)){
                 $password_error = "Password must have at least 6 characters.";
             } 
             else{
                 $password = trim($_POST["password"]);
             }
             
             // Validate confirm password
             if(empty(trim($_POST["confirm_password"])) && empty($username_error)){
                 $confirm_password_error = "Please confirm password.";     
             } else{
                 $confirm_password = trim($_POST["confirm_password"]);
                 if(empty($username_error) && empty($password_error) && ($password != $confirm_password)){
                     $confirm_password_error = "Password did not match.";
                 }
             }
             
             // Check input errors before inserting in database
             if(empty($username_error) && empty($password_error) && empty($confirm_password_error)){
                 
                 // Creates a password hash
                 $password = password_hash($password, PASSWORD_DEFAULT);

                 // Prepare SQL to insert new username, password, and empty profile image
                 $sql = "INSERT INTO users (username, password,profileimg) VALUES ('$username', '$password', 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png' )";
                 
                 if($query = mysqli_query($link, $sql)){
                      echo '

                        <script>
                          window.location.assign("https://evento-project.000webhostapp.com/login.php");
                        </script>
                        
                        ' ;
                    exit;
                 }
                 else{
                    echo "Something went wrong. Please try again later.";
                 }

             }           
      }
      
    }

   // Close connection
   mysqli_close($link);

