<?php include "head.php" ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">User Accounts</h1>
                        <br>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>User Accounts</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php
                                    $sql = "SELECT * from users";
                                    $res = mysqli_query($link,$sql); 
                                    if(mysqli_num_rows($res)>0){
                                        echo'
                                        <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>FullName</th>
                                                    <th>Email</th>
                                                    <th>Gender</th>
                                                    <th>Age</th>
                                                    <th>Phone</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                          
                                        ';
                                        
while($row = mysqli_fetch_assoc($res)){ 
                                            $username = $row["username"]; 
                                            $userid = $row['id'];
                                            $Name = $Email = $Gender = $Age = $Phone = "--" ;
                                            $sql2 = "SELECT * from userinfo WHERE userid = '$userid' ";
                                            $res2 = mysqli_query($link,$sql2); 
                                            if(mysqli_num_rows($res2)>0){
                                                $row2 = mysqli_fetch_assoc($res2);
                                                $Name = (empty($row2['lname'])||empty($row2['lname'])) ? "--" : ucfirst($row2['fname']) . "  " . ucfirst($row2['lname']) ;
                                                $Gender = (empty($row2['gender'])) ? "--" : $row2['gender']  ;
                                                $Age = (empty($row2['age'])) ? "--" : $row2['age']  ;
                                                $Email = (empty($row2['email'])) ? "--" : $row2['email']  ;
                                                $Phone = (empty($row2['phone'])) ? "--" : $row2['phone']  ;
                                            }

                                            $image = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM users WHERE username='$username'"))['profileimg'];
                                            $image == "http://ssl.gstatic.com/accounts/ui/avatar_2x.png" ? $image = $image : $image = "../../../" . $image  ;
                                            echo
                                            "
                                                <tr>
                                                    <td class='text-center'> <img src='$image' width='80px' height='80px'> <br><strong>".$username.'</strong></td>
                                                    <td>'.$Name.'</td>
                                                    <td>'.$Email.'</td>
                                                    <td>'.$Gender.'</td>
                                                    <td>'.$Age.'</td>
                                                    <td>'.$Phone.'</td>
                                                </tr>
                                            ';
                                        }
                                        echo'
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                        ';
                                    }
                                    else {
                                        echo '<h2>There are no registered users yet..</h2>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js"></script>
    </body>
</html>
