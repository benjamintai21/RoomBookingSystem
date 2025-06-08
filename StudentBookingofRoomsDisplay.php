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
//change the below to the according database
$conn=new mysqli("localhost","root","","bs_useraccounts");
//change the below to the correct names
$stmt = $conn->prepare("SELECT * FROM tb_rooms WHERE r_booked = 1 AND UID ='$_SESSION[UID]' ORDER BY roomname ASC");
$stmt -> execute();
$stmt -> store_result();
$row = $stmt -> num_rows();
// this is to remember data within $stmt
$stmt -> bind_result($r_ID, $roomname, $r_launch, $roomsize, $r_price,$r_date ,$r_starttime,$r_endtime, $r_booked,$rb_starttime,$rb_endtime, $UID);
$stmt -> execute();

$result = $stmt->get_result();
?>

<html>
<head>
        <title>Booked Rooms</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="css/loadingstyle.css">
        <link rel="stylesheet" href="css/collapsible.css"><!-- comment -->
        <link rel="stylesheet" href="css/welcome.css">
        <link rel="stylesheet" href="css/tablestyling.css">
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
                <a href="StudentBookingofRooms.php"><i class="fa-solid fa-magnifying-glass"></i> Book a Room</a>
                <a href="StudentBookingofRoomsDisplay.php" class="active"><i class="fa-solid fa-clipboard-check"></i> My Bookings</a>
                <a href="HelpPage.html" target="_blank"><i class="fa-solid fa-circle-question"></i> Help</a>
                <a href="LogoutStudent.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a>
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
<div class="links">
    <ai><i class="fa-regular fa-circle-check"></i> My Bookings</ai>
</div>
<div class="wrapper">
<?php
if ($result->num_rows > 0 ) {
  $sn=1;
  while($data = $result->fetch_assoc()) {
 ?>
    
	<div class="view_item1">
            
            <div class="vi_left">
	    <?php
            if ($data['roomname']=='Lecture Room 1.1A'){
               echo '<img src="images/lect.jpg" height= 300 width=300/>';
            }else if($data['roomname']=='Lecture Room 2.1A'){
               echo '<img src="images/lect2.jpeg" height= 300 width=300/>';
            }else if($data['roomname']=='Lecture Room 3.1A'){
               echo '<img src="images/lect3.jpeg" height= 300 width=300/>';
            }else if($data['roomname']=='Lecture Room 4.1A'){
               echo '<img src="images/lect4.jpeg" height= 300 width=300/>';
            }else if($data['roomname']=='Lecture Room 5.1A'){
               echo '<img src="images/lect5.jpeg" height= 300 width=300/>';
            }else{
               echo '<img src="images/notfound.jpg" height= 300 width=300/>';
            }
            ?>
            </div>
            <div class="vi_right">
                <h2 class="title"><u><?php echo $data['roomname']; ?></u></h2>
                                       
                                        <div class="detail">
                                            
                                            <div class="info">
                                                
                                                <p><i class="fa-solid fa-calendar-days"></i> Date: <?php echo $data['r_date']; ?></p>
                                 
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="detail">
                                            
                                            <div class="info">
                                                
                                                <p><span><i class="fa-solid fa-clock"></i> My Time Slot:  <?php echo $data['rb_starttime']; ?>HRS to <?php echo $data['rb_endtime']; ?>HRS</span></p>
                                                
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="bookingbuttonsdiv">                                        
    <?php echo "<html>"?>
            <?php echo "<div class='form-style-6'>"?>
                <?php echo "<form action='StudentEditBooking.php' method='post'>"?>
                    <?php echo "<input type ='hidden' name='r_booked' value = 1 >"?>
                    <?php echo "<input type ='hidden' name='r_ID' id='r_ID' value ='"?><?php echo $data['r_ID']; ?> <?php echo "'/>" ?>
                <button type='Submit' class="bookedbuttons"><i class="fa-regular fa-pen-to-square"></i> Edit Booking</button>
            <?php echo "</form>" ?>
        <?php echo "</div>"?>
    <?php echo "</html>"?>
        
    <?php echo "<html>"?>
            <?php echo "<div class='form-style-6'>"?>
                <form onsubmit="return confirm('Do you really want to cancel your booking? No refund will be credited!');" action="cancel_booking_backend.php" method='post'
                    <?php echo "<input type ='hidden' name='r_booked' value = 0 >"?>
                    <?php echo "<input type ='hidden' name='r_ID' id='r_ID' value ='"?><?php echo $data['r_ID']; ?> <?php echo "'/>" ?>
                <button type='Submit' class="bookedbuttons"><i class="fa-solid fa-ban"></i> Cancel Booking</button>
                </form>
        <?php echo "</div>"?>
    <?php echo "</html>"?>
                                            
                                        </div>                                                                        
    
            </div>	 
    </div>
                  <?php
        $sn++;}
        } else { 
        ?>
        <div class="view_item">
            <errortext>You Have No Booked Rooms! <i class="fa-solid fa-face-sad-tear"></i></errortext>
        <?php } ?>             
        </div>
</div>