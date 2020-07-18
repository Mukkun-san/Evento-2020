<?php include "head.php" ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Subscriptions</h1>
                        <br>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Subscriptions</div>
                            <div class="card-body">
                            <?php
                                $sql = "SELECT * from subs";
                                $res = mysqli_query($link,$sql);
                                if(mysqli_num_rows($res)>0){
                                    echo '<div class="text-center"><button class="btn btn-success "> <a style="text-decoration:none;color:white;" href="download_csv.php">Download Emails List</a> </button></div><br>
                                    ' ; 
                                    echo'
                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Subscription Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                    ';
                                    while($row = mysqli_fetch_assoc($res)){   
                                        echo
                                        '
                                            <tr>
                                                <td>'.$row["email"].'</td>
                                                <td>'.$row["date"].'</td>
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
                                }else{
                                    echo '<h2>There are no emails subscribed yet..</h2>';
                                }
                            ?>
                            
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
