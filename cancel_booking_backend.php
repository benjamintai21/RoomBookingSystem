<?php
session_start();
$p_code = $_SESSION["p_code"];
$r_booked = $_SESSION["r_booked"];
$p_code = $_SESSION["p_code"];
$r_price = $_SESSION["r_price"];
$roomname = $_SESSION["roomname"];
$discount = $_POST["discount"];

    $r_ID=$_POST["r_ID"];
    $r_booked = $_POST["r_booked"];
    $p_code=$_POST["p_code"];
    $r_price=$_POST["r_price"];
    $roomname = $_POST["roomname"];
//😊💕💕💕💕💕💕💕💕💕💕💕💕💕post time above and update below
$conn = new mysqli("localhost","root","","bs_useraccounts");
$stmt = $conn -> prepare("UPDATE tb_rooms SET r_booked='0',rb_starttime = NULL, rb_endtime= NULL WHERE r_ID=?");
$stmt -> bind_param("s",$r_ID);
$stmt -> execute();
$stmt -> close();
$conn -> close();
header("location: StudentBookingofRoomsDisplay.php");
?>