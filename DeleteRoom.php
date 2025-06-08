<?php
    $r_ID=$_POST["r_ID"];
    
    $conn = new mysqli("localhost","root","","bs_useraccounts");

    $stmt = $conn->prepare("DELETE FROM tb_rooms WHERE r_ID = ?");
    $stmt -> bind_param("s",$r_ID);
    $stmt -> execute();

    $stmt -> close();
    $conn -> close();

    echo '<script language="javascript">';
    echo 'window.history.back()';
    echo '</script>';
?>