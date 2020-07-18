<?php   
        $request = "SELECT * FROM forms WHERE username='$uname'";
        if(($result = mysqli_query($link, $request) ) == false){
            echo " query failed line 4";
        }
        $exist=false;
        // loop through reservations table if any result existed
        while($row = mysqli_fetch_assoc($result)) {
            if ($row['PACK']== $pack) {   // display reservations according to the pack 
                $exist=true;
                $uname=$_SESSION['username1'];
                $id = $row['id'];
        
                // THIS TABLE IS USED TO DISPLAY TITLES OF RESERVATION TABLES
                $arr = ['First Name', 'Last Name', 'Email', 'Identity', 'Event Format',
                         'Service', 'CheckIn', 'CheckOut', 'Document', 'Pack'];
            
                $sql = "SELECT * FROM confirmations WHERE id ='$id' ";
                $query = mysqli_query($link,$sql);
                $line = mysqli_fetch_assoc($query);
                echo '<div class="card bg-light">';
        
                if ($line['state'] == 'N/A') {
                    $color = 'text-info' ;
                    $message = '<i>Reservation Pending..</i>' ;
                }elseif ($line['state'] == 'DECLINED') {
                    $color = 'text-danger' ;
                    $message = '<i>Reservation Declined.</i>' ;
                }
                elseif ($line['state'] == 'CONFIRMED') {
                    $color = 'text-success' ;
                    $message = '<i>Reservation Confirmed!</i>' ;
                }
                $date = $row['Date'] ;
                echo"<div class='card-header row'> 
                        <div class='col'>
                            <h4 class='$color'> $message </h4>
                            <small> $date </small>
                        </div>";
        
                if ($line['state'] == 'N/A') { // DISPLAY CANCEL BUTTON ONLY IF RESERVATION IS PENDING
                    echo "<div class='col'><button class='btn redbg float-right' ><a href='_/Reservations/delete.php?id=". $row['id'] ."' style='color:#fff!important;'>Cancel Reservation</a></button> </div>";
                    }
                echo"</div>";      
                echo '<div class="card-body">' ;
                echo"<table class='table table-bordered text-center' width='100%'><thead class='thead-light'>
                <tr>";
                for ($i=0; $i < 5; $i++) { 
                    echo '<th scope="col">'.$arr[$i].'</th>' ;
                }
                echo "</tr></thead><tbody><tr>";
                $k=-2;
                foreach ($row as $value) {
                    $k+=1;
                    if ($k == -1 || $k == 0 || $k == 11) {
                        continue;
                    }
                
                    if ($k == 9 && $row['PACK'] == "gold") {
                        echo '<td><a class="text-secondary" href=" '.$value.' "> <i class="fa fa-download text-info" aria-hidden="true"></i> <br>Download
                        </a></td>' ;
                        continue;
                    }
                    
                    echo "<td>$value</td>" ;
                    
                    if ($k==5) {
                        echo "</tr></tbody></table><table class='table table-bordered text-center' width='100%'><thead class='thead-light'>
                        <tr>";
                        for ($i=5; $i <= 9; $i++) { 
                            
                            echo '<th scope="col">'.$arr[$i].'</th>' ;
                        }
                        echo "</tr></thead><tbody><tr>";
                    }

                    
                    
                } 
                echo"</tr></tbody></table></div></div> <hr>";
            }
        } 
        if (!$exist) {
            echo'<h3>You don\'t have '. $pack .' reservations yet...</h3>
            <a href="'.$pack.' form.php" class="btn reserve ">
            RESERVE NOW</a>';
        }

?>

<style>
    table{
        font-size: 15px!important;
    }
    .redbg, .redbg:active {
        background-color: #E02F2F!important ;
        border : none!important; 
    }
    .redbg:hover {
        background-color: #770101!important ;
        color : white!important ;
    }
</style>


