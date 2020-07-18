<?php 

include '_/common_html/head.php'; 
echo $_SESSION['PACK'];
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo '<script>
    window.location.assign("https://evento-project.000webhostapp.com/login.php")
  </script>' ;
      exit;
}

include 'config.php';

include '_/Profile/imageState.php' ;

?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="_/Profile/validate_image.js"></script>

    <title>Profile</title>
</head>
<body>

    <?php include '_/common_html/nav.php'; ?>
    <br><br><br>

    <div>
        <div class="container-fluid p-4 mb-5">
            <!--left col-->
            <div class="row " >
                <div class="col-sm-10"></div>
            </div>
            <hr> 
<div class="row">

<!-- LEFT COLUMN : "Reservations-PersonalInfo"  -->
                <div class="col-sm-8 ml-5">
                    <h2>WELCOME <b> <?php echo $_SESSION["username1"]; ?> </b>!</h2>
                    <br>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="row nav-item">                        
                        <a class=" nav-link active" data-toggle="tab" href="#menu2">Personal Information</a>
                        <a class=" nav-link " data-toggle="tab" href="#menu1">Reservations</a>
                        </li>
                    </ul>


                
            
                    <!-- USER INFORMATION WILL BE PROCESSED & DISPLAYED BY THIS PHP SCRIPT -->
                    <?php  include '_/Profile/userInformation.php' ; ?>

                    <!-- Tab panes -->
                    <div class="tab-content bg ">
                        <div id="menu2" class="container tab-pane active"><br>
                        <ul class="nav nav-tabs">
                                <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#View">View Information</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#Submitinfo">Submit Information</a>
                                </li>
                        </ul>



                        <!-- display user information -->
                        <div class="tab-content"><br>
                                <div id="View" class="container tab-pane active">
                                    <h3>View Info Here  </h3> 
                                    <br>
                                    <h5>First Name : <small>  <?php echo $fName ?> </small>  </h5> 
                                    <h5>Last Name : <small>  <?php echo $lName ?> </small>  </h5> 
                                    <h5>Age : <small>  <?php echo $Age ?> </small> </h5>  
                                    <h5>Gender : <small>  <?php echo $Gender ?> </small> </h5>  
                                    <h5>Email : <small>  <?php echo $Email ?> </small> </h5>  
                                    <h5>Phone :  <small>  <?php echo $Phone ?> </small>  </h5> 
                                    <h5>Address : <small>  <?php echo $Address ?> </small> </h5>  
                                    <h5>City : <small>  <?php echo $City ?> </small>  </h5> 
                        </div>

                        <!-- FORM to submit user information -->
                        <div id="Submitinfo" class="container tab-pane fade">
                            <form action="profile.php" method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                    <label >First Name</label>
                                    <input type="text" class="form-control" name="ufname">
                                    </div>
                                    <div class="form-group col-md-5">
                                    <label >Last Name</label>
                                    <input name="ulname" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-2">
                                    <label >Age</label>
                                    <input name="uage" type="number" min=18 max=99 class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-7">
                                    <label >Email</label>
                                    <input name="uemail" type="email" class="form-control">
                                    </div>
                                    <div class="col-5">
                                        <label >Phone</label>
                                        <input name="uphone" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row col-10">
                                    <label for="inputAddress">Address</label>
                                    <input name="uaddress" type="text" class="form-control" >
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputCity">City</label>
                                    <input name="ucity" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label> Gender: </label>
                                        <input name="ugender"  type="radio"  value="Male" checked>
                                        <label> Male </label>
                                        <input name="ugender" type="radio" value="Female">
                                        <label> Female </label>
                                </div>
                                <button type="submit" name="Submit_userInfo" class="btn btn-success">Submit Information</button>

                                <button type="submit" name="Delete_userInfo" class="btn btn-info redbg">Delete Information</button>
                            </form>
                        </div>

                        </div>
                        </div>
                        <div id="menu1" class="container tab-pane fade"><br>
                            <h3>Select Offer</h3>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#bronze">Bronze</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#silver">Silver</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#gold">Gold</a>
                                </li>
                            </ul>                          
                            <div class="tab-content">
                                <div id="bronze" class="container tab-pane active"><br>
                                    
                                    <?php 
                                        $pack = "bronze";
                                        include '_/Reservations/reservDisplay.php';
                                    ?>

                                </div>
                                <div id="silver" class="container tab-pane fade"><br>
                                    <h3></h3>
                                    <?php 
                                         $pack = "silver";
                                         include '_/Reservations/reservDisplay.php';
                                    ?>
                                </div>
                                <div id="gold" class="container tab-pane fade"><br>
                                    <h3></h3>
                                    <?php 
                                         $pack = "gold";
                                         include '_/Reservations/reservDisplay.php';
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

<!-- RIGHT COLUMN: "ProfilePic - Activity" -->
                <div class="col-xl-3 col-xs-8 bg-light mx-3">

                    <!-- Profile Picture -->
                    <div class="text-center ">
                        <img src="<?php echo $_SESSION['profileImg']; ?>" class="avatar img-square img-thumbnail" alt="avatar">
                        <br>
                        <h6></h6>
                        <form action="_/Profile/imgUpload.php" method="POST" enctype="multipart/form-data">
                            <?php
                            if ($_SESSION['profileImg'] != 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png') {
                                echo ' 
                                <input type="submit" name="imgdel" class="btn-sm redbg" style="width:50%;" value="Remove Picture">
                                ' ;
                            }else {
                                echo  '
                                <div class="input-group">
                                <input type="file" class="custom-file-input text-center center-block file-upload" onchange="ValidateImgInput(this);"  id="inputGroupFile01" name="profileimg" >
                                <label class="custom-file-label text-left" for="inputGroupFile01">Change photo...</label>
                                </div>
                                <br>
                                <input type="submit" name="imgsubmit" class="btn-sm btn-success" style="width:50%;" value="Upload">
                                ' ;
                            }
                            ?>                          
                        </form>
                    </div>
                    </hr><br>
                    
                    <!-- ACTIVITY -->
                    <ul class="list-group text-center ">
                        <li class="list-group-item ">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                        <li class="list-group-item text-left"><span class="pull-left"><strong>Total Reservations: </strong></span>
                        <?php 
                            include'_/Reservations/reservation_counter.php' ;
                            echo '&emsp;' . $Total_Reservs ;
                        ?>
                        </li>
                        <li class="list-group-item text-left"><span class="pull-left"><strong>Bronze: </strong></span> <?php echo '&emsp;' . $Bronze_Reservs ;?></li>
                        <li class="list-group-item text-left"><span class="pull-left"><strong>Silver: </strong></span> <?php echo '&emsp;' . $Silver_Reservs ;?></li> </li>
                        <li class="list-group-item text-left"><span class="pull-left"><strong>Gold: </strong></span> <?php echo '&emsp;' . $Gold_Reservs ;?></li> </li>
                    </ul> 
                        
                    <div class="panel panel-default m-4 bg-light">
                        
                        <div class="text-center">
                            <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
                            <a href="logout.php" class="btn btn-warning">Sign Out of Your Account</a>
                        </div>
                    </div>
                    
            </div> 

            </div><!--/tab-pane-->
            
        
        </div><!--/tab-content-->

    </div><!--/col-9-->

	<script>
        $(document).ready(function() {
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }
            
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $(".file-upload").on('change', function(){
                readURL(this);
            });
        });
	</script>
	
    <?php include '_/common_html/footer.php'; ?>

    <style>
        .text-primary, .btn, .btn:hover{
            color:#fff!important;
            border : none!important; 
        }
        .redbg, .redbg:active {
            background-color: #E02F2F!important ;
            color:#fff!important;
            border : none!important; 
        }
        .redbg:hover {
            background-color: #770101!important ;
            color : white!important ;
        }
        .reserve{
            background-color: #12B246!important ;
            color : black!important ;
        }
        .reserve:hover{
            background-color: #16562B!important ;
            color : white!important ;
        }
    </style>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>