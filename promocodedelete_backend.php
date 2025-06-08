<?php
    $p_id=$_POST["p_id"];
    
    $conn = new mysqli("localhost","root","","bs_useraccounts");

    $stmt = $conn->prepare("DELETE FROM tb_codes WHERE p_id = ?");
    $stmt -> bind_param("s",$p_id);
    $stmt -> execute();

    $stmt -> close();
    $conn -> close();

    echo '<script language="javascript">';
    echo 'window.history.back()';
    echo '</script>';
?>