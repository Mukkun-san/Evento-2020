<?php

$sql = "SELECT * FROM forms WHERE username='$uname'";
$result = mysqli_query($link, $sql);

$Total_Reservs = 0;
$Bronze_Reservs = 0;
$Silver_Reservs = 0;
$Gold_Reservs = 0;

while($row = mysqli_fetch_assoc($result)) {
    $Total_Reservs+=1;
    if ($row['PACK']=='bronze') {
        $Bronze_Reservs += 1 ;
    }
    if ($row['PACK']=='silver') {
        $Silver_Reservs += 1 ;
    }
    if ($row['PACK']=='gold') {
        $Gold_Reservs += 1 ;
    }
} 

?>