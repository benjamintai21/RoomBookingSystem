<!DOCTYPE html>
<?php
session_start();
$UID = $_SESSION["UID"];
$ADMIN = $_SESSION["ADMIN"];
$s_firstname = $_SESSION["s_name"];
$s_username = $_SESSION["s_username"];

if ( !isset( $_SESSION[ 'UID' ]   )) {
    header( 'Location: StaffLogin.php' );
}
$r_ID=$_POST["r_ID"];

$conn = new mysqli("localhost","root","","bs_useraccounts");

$stmt = $conn -> prepare("SELECT * FROM tb_rooms WHERE r_ID = ?");
$stmt -> bind_param('s', $r_ID);
$stmt -> bind_result($r_ID, $roomname, $r_launch, $roomsize, $r_price,$r_date ,$r_starttime,$r_endtime, $r_booked,$UID,$rb_starttime,$rb_endtime);
$stmt -> execute();
$stmt -> fetch();
$stmt -> close();
$conn -> close();
?>

<html>
    <head>
        <title>Edit Room</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="css/loadingstyle.css">
        <link rel="stylesheet" href="css/welcome.css">
        <link rel="stylesheet" href="css/tablestyling.css">
        <link rel="stylesheet" href="css/roomcreatestyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    
    <body>     
    <header class="header">
        <div class="logo"> 
            <a href="StaffPage.php">
                <img src="images/logo_uow.png" height="60px" alt="University of Wollongong Logo">
            </a>
          
        </div>

            <nav class="navbar">
                <a href="StaffPage.php"><i class="fa-solid fa-house"></i> Home</a>
                <a href="StaffLaunchingofRooms.php" class="active"><i class="fa-solid fa-magnifying-glass"></i> Manage Rooms</a>
                <a href="HelpPage.html" target="_blank"><i class="fa-solid fa-circle-question"></i> Help</a>
                <a href="LogoutStaff.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a>
            </nav>
        </header>
<div class="loader"></div>
<script>
  window.addEventListener("load", () => {     
       
  document.querySelector(".loader").classList.add("loader--hidden");
  document.querySelector(".loader").addEventListener("transitionend", () => {
  document.body.removeChild(document.querySelector(".loader"));
  });
});
</script>

        <fieldset>
            <h1><u>Edit A Room</u></h1>
            <br>
            <form class="form-style-6" action="edit_rooms_backend.php" method="post">
                
                <h2 class='center' style="color:red"><u>*You are editing for <?=$roomname?>*</u></h2>         
                             
                <br>
                
                <input type="hidden" name="r_ID" value="<?=$r_ID?>"/>
                
                
                <label>Edit Room Name :</label>
                <input type="text" name="roomname" value="<?=$roomname?>"/>
                
                <br>
                
                <label>Edit Room Size :</label>
                <input type="number" name="roomsize" value="<?=$roomsize?>"/> pax
                
                <br>
                
                <label>Edit Room Price : $</label>
                <input type="number" name="r_price" value="<?=$r_price?>"/> /hr
                
                <br><!-- comment -->
                
                <button type="button" class="launchbutton" onclick="window.history.back()"><i class="fa-solid fa-arrow-left"></i> Back</button>
                <button type="submit" class="launchbutton1" style="float:right"><i class="fa-solid fa-check"></i> Confirm</button>
                
            </form>
        </fieldset>

    </body>
</html>

