<?php

$r_ID=$_POST["r_ID"];
$roomname=$_POST["roomname"];
$roomsize=$_POST["roomsize"];
$r_price=$_POST["r_price"];
$rb_starttime=$_POST["rb_starttime"];
$rb_endtime=$_POST["rb_endtime"];

$conn=new mysqli("localhost","root","","bs_useraccounts");

$stmt = $conn -> prepare("UPDATE tb_rooms SET rb_starttime = '$rb_starttime', rb_endtime = '$rb_endtime' WHERE r_ID = '$r_ID'");
//😊💕💕💕💕💕💕💕💕💕💕💕💕💕add variable of time above to update

$stmt -> execute();
$stmt -> close();
$conn -> close();

header("Location: StudentBookingofRoomsDisplay.php");
?>