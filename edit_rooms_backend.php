<?php

$r_ID=$_POST["r_ID"];
$roomname=$_POST["roomname"];
$roomsize=$_POST["roomsize"];
$r_price=$_POST["r_price"];

$conn=new mysqli("localhost","root","","bs_useraccounts");

if (empty($roomname) || $roomsize <= 0 || $r_price <= 0){
    $r_ID=$_POST["r_ID"];
    echo '<script language="javascript">';
    echo 'alert("Invalid!");';
    echo 'window.history.back()';
    echo '</script>';
    
}else{
    
    $stmt = $conn -> prepare("UPDATE tb_rooms SET roomname = '$roomname', roomsize = '$roomsize', r_price = '$r_price' WHERE r_ID = '$r_ID'");
    $stmt -> execute();
    $stmt -> close();
    $conn -> close();
    header("Location: StaffLaunchingofRooms.php");
}
?>
