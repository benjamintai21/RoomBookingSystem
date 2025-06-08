<!DOCTYPE html>
<?php
session_start();
$UID = $_SESSION["UID"];
$ADMIN = $_SESSION["ADMIN"];
$s_firstname = $_SESSION["s_name"];
$s_username = $_SESSION["s_username"];
    
if ( !isset( $_SESSION[ 'UID' ]   )) {
header( 'Location: StudentLogin.php' );
}

$r_ID=$_POST["r_ID"];

$conn = new mysqli("localhost","root","","bs_useraccounts");

$stmt = $conn -> prepare("SELECT * FROM tb_rooms WHERE r_ID = ?");
$stmt -> bind_param('s' , $r_ID);
$stmt -> bind_result($r_ID , $roomname , $r_launch , $roomsize , $r_price , $r_date , $r_starttime , $r_endtime , $r_booked , $rb_starttime , $rb_endtime , $UID);
$stmt -> execute();
$stmt -> fetch();
$stmt -> close();
$conn -> close();
?>

<html>    
<head>
        <title>Available Rooms</title>
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
            <a href="StudentPage.php">
                <img src="images/logo_uow.png" height="60px" alt="University of Wollongong Logo">
            </a>
          
        </div>

            <nav class="navbar">
                <a href="StudentPage.php"><i class="fa-solid fa-house"></i> Home</a>
                <a href="StudentBookingofRooms.php" class="active"><i class="fa-solid fa-magnifying-glass"></i> Book a Room</a>
                <a href="StudentBookingofRoomsDisplay.php"><i class="fa-solid fa-clipboard-check"></i> My Bookings</a>
                <a href="HelpPage.html" target="_blank"><i class="fa-solid fa-circle-question"></i> Help</a>
                <a href="StudentLogout.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a>
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

<script>
    function validatebookedtiming(){        
        var starttime = <?=$r_starttime?>;
        var endtime= <?=$r_endtime?>;
        var rb_starttime = document.getElementById("rb_editstarttime").value;
        var rb_endtime = document.getElementById("rb_editendtime").value;
        var p_rbstarttime = parseInt(rb_starttime) + 1;
        var p_rbendtime = parseInt(rb_endtime) - 1;

        if(starttime < p_rbstarttime && endtime > p_rbendtime){
            if(p_rbendtime < p_rbstarttime){
                alert("Please choose a valid timing!");
                return false;
            }else{
                alert("Success!");
                return true;
            }
        }else{
            alert("Choose within the available time slots!");
            return false;
        }
    }
</script>

<fieldset>
            <h1><u>Edit Booking Timing</u></h1>
            <br>
            <form class="form-style-6" onsubmit="return validatebookedtiming();" action="studenteditbooking_backend.php" method="post">
                
                <h2 class='center' style="color:red"><u>*You are editing for <?=$roomname?>*</u></h2>         
                             
                <br>
                
                <input type="hidden" name="r_ID" value="<?=$r_ID?>" readonly>
                
                
                <label>Room Name :</label>
                <input type="textbox" name="roomname" class="tb1" value="<?=$roomname?>" readonly>
                
                <br><br>
                
                <label>Room Size :</label>
                <input type="textbox" name="roomsize" class="tb1" value="<?=$roomsize?>" readonly>
                
                <br><br>
                
                <label>Room Price :</label>
                <input type="textbox" name="r_price" class="tb1" value="<?=$r_price?>" readonly>
                
                <br><br>
                
                <label>Date :</label>
                <input type="textbox" name="r_price" class="tb1" value="<?=$r_date?>" readonly>
                
                <br><br>
                <p><span><i class="fa-solid fa-clock"></i> Launched Hours:  <?=$r_starttime?> HRS to <?=$r_endtime?> HRS</span></p>
                <br>
                
                <u>Booked Hours</u><br>
                
                From :<select name="rb_starttime" id="rb_editstarttime">
                        <option value="<?=$rb_starttime?>"><?=$rb_starttime?>HRS</option>
                        <option value=""></option>
                        <option value="0800">08:00HR</option>
                        <option value="0900">09:00HR</option>
                        <option value="1000">10:00HR</option>
                        <option value="1100">11:00HR</option>
                        <option value="1200">12:00HR</option>
                        <option value="1300">13:00HR</option>
                        <option value="1400">14:00HR</option>
                        <option value="1500">15:00HR</option>                    
                    </select>        

                
                To: <select name="rb_endtime" id="rb_editendtime">
                        <option value="<?=$rb_endtime?>"><?=$rb_endtime?>HRS</option>
                        <option value=""></option>
                        <option value="0800">08:00HR</option>
                        <option value="0900">09:00HR</option>
                        <option value="1000">10:00HR</option>
                        <option value="1100">11:00HR</option>
                        <option value="1200">12:00HR</option>
                        <option value="1300">13:00HR</option>
                        <option value="1400">14:00HR</option>
                        <option value="1500">15:00HR</option>
                </select>        

                <br><br>
                
                <button type="button" class="launchbutton" onclick="window.history.back()"><i class="fa-solid fa-arrow-left"></i> Back</button>
                <button type="submit" class="launchbutton1" style="float:right"><i class="fa-solid fa-check"></i> Confirm</button>
                
            </form>
</fieldset>
</body>
</html>



<!--    add time edit for students-->