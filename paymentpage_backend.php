<?php
session_start();
$UID = $_SESSION["UID"];
$ADMIN = $_SESSION["ADMIN"];
$s_firstname = $_SESSION["s_name"];
$s_username = $_SESSION["s_username"];

$r_ID=$_POST["r_ID"];
$r_booked = $_POST["r_booked"];
$r_price=$_POST["r_price"];
$roomname=$_POST["roomname"];
$rb_starttime=$_POST["rb_starttime"];
$rb_endtime=$_POST["rb_endtime"];



//😊💕💕💕💕💕💕💕💕💕💕💕💕💕post time above and update below
$conn = new mysqli("localhost","root","","bs_useraccounts");
$stmt = $conn -> prepare("UPDATE tb_rooms SET r_booked='1' , UID='$_SESSION[UID]' , rb_starttime=? , rb_endtime=? WHERE r_ID=?");
$stmt -> bind_param("sss",$rb_starttime,$rb_endtime,$r_ID);
$stmt -> execute();
$stmt -> close();
$conn -> close();
header("location: PaymentSuccess.html");
?>