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
    
//change the below to the according database
$conn=new mysqli("localhost","root","","bs_useraccounts");
//change the below to the correct names
$stmt = $conn->prepare("SELECT * FROM tb_rooms WHERE r_launch = 1 ORDER BY roomname ASC");
$stmt -> execute();
$stmt -> store_result();
$row = $stmt -> num_rows();
// this is to remember data within $stmt
$stmt -> bind_result($r_ID, $roomname, $r_launch, $roomsize, $r_price,$r_date ,$r_starttime,$r_endtime, $r_booked,$UID,$rb_starttime,$rb_endtime);
$stmt -> execute();
$result = $stmt->get_result(); 
?>

<html>    
<head>
        <title>Student Dashboard</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="css/loadingstyle.css">
        <link rel="stylesheet" href="css/roomlauncher.css"><!-- comment -->
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
       <h1><u>Unlaunch A Room</u></h1>
       
        <br><br><!-- Launch Room -->
        
    <table border="1" cellspacing="0" cellpadding="10">
  <tr>
    <th>Room</th>
    <th>Room Name</th>
    <th>Room Size</th>
    <th>Room Price/hr ($)</th>
    <th>Date (DDMMYYYY)</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Booking Status</th>
    <th>Unlaunch</th>
  </tr>
<?php
if ($result->num_rows > 0 ) {
  $sn=1;
  while($data = $result->fetch_assoc()) {
    $bookingstatusErr = $bookingstatusSuccess = "";
    if($data['r_booked']==1){
    $bookingstatusErr = 'Active Booking!*';
    }else{
        $bookingstatusSuccess = 'No Booking Record!';
    }
 ?>
 <tr>
   <td>
       <?php
       if ($data['roomname']=='Lecture Room 1.1A'){
           echo '<img src="images/lect.jpg" height= 100 width=100/>';
       }else if($data['roomname']=='Lecture Room 2.1A'){
           echo '<img src="images/lect2.jpeg" height= 100 width=100/>';
       }else if($data['roomname']=='Lecture Room 3.1A'){
           echo '<img src="images/lect3.jpeg" height= 100 width=100/>';
       }else if($data['roomname']=='Lecture Room 4.1A'){
           echo '<img src="images/lect4.jpeg" height= 100 width=100/>';
       }else if($data['roomname']=='Lecture Room 5.1A'){
           echo '<img src="images/lect5.jpeg" height= 100 width=100/>';
       }else{
           echo '<img src="images/notfound.jpg" height= 100 width=100/>';
       }
       ?>
   </td>
   <td><?php echo $data['roomname']; ?> </td>
   <td><?php echo $data['roomsize']; ?> pax </td>
   <td>$<?php echo $data['r_price']; ?> </td>
  
   <td><?php echo $data['r_date']; ?> </td>
   <td><?php echo $data['r_starttime']; ?>HRS </td>
   <td><?php echo $data['r_endtime']; ?>HRS </td>
   
   <td class="bookingstatus">
       <span style="color: #e02424;"><?php echo $bookingstatusErr; ?></span>
       <span style="color: #28de62;"><?php echo $bookingstatusSuccess; ?></span>
   </td>
   
           
   
   <td> 
       <?php echo "<html>"?>
       
            <?php echo "<div class='form-style-6'>"?>
            <form onsubmit="return confirm('Do you really want unlaunch this room, this cannot be undone!');" action='unlaunch_backend.php' method='post'>
                    <?php echo "<input type ='hidden' name='r_launch' value = 0 >"?>
                    <?php echo "<input type ='hidden' name='r_ID' id='r_ID' value ='"?><?php echo $data['r_ID']; ?> <?php echo "'/>" ?>
                <button type='Submit' class="roombuttons"><i class="fa-solid fa-xmark"></i> Unlaunch</button>
            </form>
        <?php echo "</div>"?>
     <?php echo "</html>"?>
   </td>
  
 </tr>
 <?php
  $sn++;}
} else { 
  ?>
    <tr>
     <td colspan="9">No Rooms Currently Launched</td>
    </tr>





<?php } ?>
    </table>
        <br><!-- comment -->
        
        
        
        <form onsubmit="return confirm('Do you really want to unlaunch all rooms, this cannot be undone!');" action="unlaunchall_backend.php" method="POST">
            <button type="button" class="launchbutton" onclick="location.reload()"><i class="fa-solid fa-rotate-right"></i></button>
            <button type="submit"  class="launchbutton"style="float: right;"><i class="fa-solid fa-ban"></i> Unlaunch All Rooms</button>
            <button type="button" class="launchbutton"style="float: right;" onclick="location.href='StaffLaunchingofRooms.php'"><i class="fa-solid fa-rocket"></i> Launch Room</button>
        </form>
        
    </fieldset>
</body>
</html>