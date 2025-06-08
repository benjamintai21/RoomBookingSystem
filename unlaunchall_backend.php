<?php

$conn = new mysqli("localhost","root","","bs_useraccounts");
$stmt = $conn -> prepare("UPDATE tb_rooms SET r_launch='0' , r_date='0' , r_starttime='0' , r_endtime='0' , r_booked='0' , rb_starttime='0' , rb_endtime='0' , UID='0'");
$stmt -> execute();
$stmt -> close();
$conn -> close();
echo '<script language="javascript">';
echo 'window.history.back()';
echo '</script>';
?>

