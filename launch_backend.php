<?php
$r_ID=$_POST["r_ID"];
$r_launch = $_POST["r_launch"];
$r_date = $_POST["r_date"];
$r_starttime = $_POST["r_starttime"];
$r_endtime = $_POST["r_endtime"];
 
if($r_starttime - $r_endtime >=0){
    echo '<script language="javascript">';
    echo 'alert("You have chosen an invalid timing!");';
    echo 'window.history.back()';
    echo '</script>';
}else{
    $conn = new mysqli("localhost","root","","bs_useraccounts");
    $stmt = $conn -> prepare("UPDATE tb_rooms SET r_launch='1', r_date=?, r_starttime=?, r_endtime=? WHERE r_ID=?");
    $stmt -> bind_param("ssss",$r_date,$r_starttime,$r_endtime,$r_ID);    $stmt -> execute();
    $stmt -> close();
    $conn -> close();
    echo '<script language="javascript">';
    echo 'alert("Success!");';
    echo 'window.history.back()';
    echo '</script>';
}
?>




