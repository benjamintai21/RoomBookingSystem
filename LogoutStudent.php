<?php
session_start(); //to ensure you are using same session
session_unset(); //destroy the session
session_destroy();
header("Location: StudentLogin.php"); //to redirect back to "index.php" after logging out
exit();
?>

