<!DOCTYPE html>
<?php
session_start();
if ( !isset( $_SESSION[ 'UID' ]   )) {
    header( 'Location: StaffLogin.php' );
}
?>

<html>
    <head>
        <title>Staff Dashboard</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="css/welcome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
    </head>

    <body>
        <header class="header">
            <a href="StaffPage.html">
                <img src="images/logo_uow.png" class="logo" alt="University of Wollongong Logo">                
            </a>
            <div class="usersession">
               
            </div>
           
          
            <nav class="navbar">
                <a href="StaffPage.php" class="active"><i class="fa-solid fa-house"></i> Home</a>
                <a href="StaffLaunchingofRooms.php"><i class="fa-solid fa-magnifying-glass"></i> Manage Rooms</a>
                <a href="HelpPage.html" target="_blank"><i class="fa-solid fa-circle-question"></i> Help</a>
                <a href="LogoutStaff.php"><i class="fa-solid fa-right-from-bracket" ></i> Sign Out</a>
            </nav>     
        </header>
        
        <fieldset class="center">
            <h1><p>Welcome To Room Booking System, <b><u><?php echo $_SESSION["s_username"]?>!</u></b></p></h1><!-- comment -->
            
            <br><br><!-- comment -->
            
            
        
            
            <div>
                <button type="button" class="buttonstyle" onclick="location.href='StaffLaunchingofRooms.php'">MANAGE ROOMS</button>
	        <button type="button" class="buttonstyle" onclick="location.href='StaffPromoCode.php'"><i class="fa-solid fa-tags"></i>ADD PROMO CODE</button>
            </div>

        </fieldset>
    </body>
</html>
