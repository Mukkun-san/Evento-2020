<?php include "head.php" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid ">
                        <h1 class="mt-4">Reservations</h1>
                        <br>
                            <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Reservations</div>
                            <div class="card-body">
                                <?php
                                $sql = "SELECT * from forms";
                                $res = mysqli_query($link,$sql);
                                if(mysqli_num_rows($res)>0){
                                    echo'
                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th >Username</th>   
                                                <th >Email</th>   
                                                <th >Identity</th>   
                                                <th >Format</th>   
                                                <th >Service</th>   
                                                <th >Check-in</th> 
                                                <th >Check-out</th> 
                                                <th >DOC</th> 
                                                <th >State</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                    ';
                                    while($row = mysqli_fetch_assoc($res)){   
                                        echo
                                        '
                                            <tr>
                                            <td>'.$row["username"].'</td>
                                            <td>'.$row["email"].'</td>
                                            <td>'.$row["identity"].'</td>
                                            <td>'.$row["format"].'</td>
                                            <td>'.$row["service"].'</td>
                                            <td>'.$row["checkin"].'</td>
                                            <td>'.$row["checkout"].'</td>';
                                        
                                        if ($row["doc"] == "N/A") {
                                            echo '<td>'.$row["doc"].'</td>';
                                        }
                                        else {    
                                           echo'
                                            <td class="text-center"> <a class="text-secondary" href="../../../'.$row["doc"].'" > <i class="text-info fa fa-download fa-1x" aria-hidden="true"></i><br>Download
                                            </a> </td>';
                                        }
                                        
                                        $id = $row['id'];
                                        $sql = "SELECT * FROM confirmations WHERE id='$id'" ;
                                        $query = mysqli_query($link,$sql);
                                        $row = mysqli_fetch_assoc($query);
                                        if ($row['state'] == 'N/A') {
                                            echo 
                                        '   <td>
                                                <form action="confirm_reservation.php" method="GET" >
                                                    <input class="btn btn-success" type="submit" value="Accept" >
                                                    <input type="hidden" name="ResID" value="'.$id.'" > </span>
                                                </form>
                                                <form action="decline_reservation.php" method="GET" >
                                                    <input  name="RES" class="btn btn-danger" type="submit" value="Decline" >
                                                    <input type="hidden" name="ResID" value="'.$id.'" > </span>
                                                </form>
                                            </td>
                                            </tr>
                                        ';
                                        }
                                        
                                        else {
                                            if ($row['state'] == 'CONFIRMED')
                                            {$color = 'green';} else $color = 'red';
                                            echo '<td> <span style="color:'.$color.';">'.$row['state']."</span> <br> by:  ".  strtoupper($row['admin']) .' </td> </tr>';
                                        }
                                        
                                    }
                                    echo'
                                    </tbody>
                                    </table>
                                    </div>
                                    </div>
                                    </div>
                                    ';
                                }else{
                                    echo '<h2>There are no reservations made yet..</h2>';
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
