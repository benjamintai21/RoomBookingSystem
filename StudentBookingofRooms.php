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
$stmt = $conn->prepare("SELECT * FROM tb_rooms WHERE r_launch = 1 AND r_booked = 0 ORDER BY roomname ASC");
$stmt -> execute();
$stmt -> store_result();
$row = $stmt -> num_rows();
// this is to remember data within $stmt
$stmt -> bind_result($r_ID, $roomname, $r_launch, $roomsize, $r_price, $r_date ,$r_starttime,$r_endtime, $r_booked,$rb_starttime,$rb_endtime, $UID);
$stmt -> execute();

$result = $stmt->get_result();
?>

<html>    
<head>
        <title>Available Rooms</title>
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
                <a href="StudentBookingofRooms.php" class="active"><i class="fa-solid fa-magnifying-glass"></i> Book a Room</a>
                <a href="StudentBookingofRoomsDisplay.php"><i class="fa-solid fa-clipboard-check"></i> My Bookings</a>
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

<script>
    function validatetiming(){
        
        var starttime = document.getElementById("r_starttime").value;
        var endtime= document.getElementById("r_endtime").value;
        var rb_starttime = document.getElementById("rb_starttime").value;
        var rb_endtime = document.getElementById("rb_endtime").value;
        
        var p_starttime = parseInt(starttime);
        var p_endtime = parseInt(endtime);
        var p_rbstarttime = parseInt(rb_starttime) + 1;
        var p_rbendtime = parseInt(rb_endtime) - 1;

        if(p_starttime < p_rbstarttime && p_endtime > p_rbendtime){
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

<div class="links">
    <h1><i class="fa-solid fa-list-check"></i> Available Rooms For Booking</h1>
</div>
<div class="wrapper">
<?php
if ($result->num_rows > 0 ) {
  $sn=1;
  while($data = $result->fetch_assoc()) {
 ?>
    
	<div class="view_item">
            
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
                                        <h2 class="title"><?php echo $data['roomname']; ?></h2>
                                        
					<p class="content">
                                            <?php if ($data['roomname']=='Lecture Room 1.1A'){
                                            echo 'This spacious Lecture Room is located at Blk A Level 1 and has max capacity of 50 pax. Used for small lectures.';
                                        }else if($data['roomname']=='Lecture Room 2.1A'){
                                            echo 'This spacious Lecture Room is located at Blk A Level 2 and has max capacity of 100 pax. Used for small to medium lectures.';
                                        }else if($data['roomname']=='Lecture Room 3.1A'){
                                            echo 'This spacious Lecture Room is located at Blk A Level 3 and has max capacity of 150 pax. Useful for medium to large lectures.';
                                        }else if($data['roomname']=='Lecture Room 4.1A'){
                                           echo 'This spacious Lecture Room is located at Blk A Level 4 and has max capacity of 300 pax. Useful for large lectures.';
                                        }else if($data['roomname']=='Lecture Room 5.1A'){
                                           echo 'This spacious Lecture Room is located at Blk A Level 5 and has max capacity of 1000 pax. Useful for very large lectures or events.';
                                        }else {
                                            echo 'No information available at this moment';
                                        }
                                        ?>
                                        <div class="detail">
                                            
                                            <div class="info">
                                                
                                                <p><span><i class="fa-solid fa-clock"></i>Available Booking Hours: <br> <?php echo $data['r_starttime']; ?>HRS to <?php echo $data['r_endtime']; ?>HRS</span></p>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="detail">
                                            
                                            <div class="info">
                                                
                                                <p><i class="fa-solid fa-dollar-sign"></i>Cost: $<?php echo $data['r_price']; ?></p>
                                    
                                            </div>
                                            
                                            
                                        </div>
                                    
                                        <form onsubmit="return validatetiming();" action='applypromo.php' method='post'>
                                            <?php echo "<input type ='hidden' name='r_booked' value =1 >"?> 
                                            <?php echo "<input type ='hidden' name='r_price' id='r_price' value ='"?><?php echo $data['r_price']; ?> <?php echo "'/>" ?>
                                            <?php echo "<input type ='hidden' name='roomname' id='roomname' value ='"?><?php echo $data['roomname']; ?> <?php echo "'/>" ?>  
                                            <?php echo "<input type ='hidden' name='r_date' id='r_date' value ='"?><?php echo $data['r_date']; ?> <?php echo "'/>" ?>  
                                            <?php echo "<input type ='hidden' name='r_starttime' id='r_starttime' value ='"?><?php echo $data['r_starttime']; ?> <?php echo "'/>" ?> 
                                            <?php echo "<input type ='hidden' name='r_endtime' id='r_endtime' value ='"?><?php echo $data['r_endtime']; ?> <?php echo "'/>" ?> 
                                            Start Time: <select name="rb_starttime" id="rb_starttime">
                                                <option value="0800">08:00HR</option>
                                                <option value="0900">09:00HR</option>
                                                <option value="1000">10:00HR</option>
                                                <option value="1100">11:00HR</option>
                                                <option value="1200">12:00HR</option>
                                                <option value="1300">13:00HR</option>
                                                <option value="1400">14:00HR</option>
                                                <option value="1500">15:00HR</option>                    
                                            </select>        

                                            End Time: <select name="rb_endtime" id="rb_endtime">
                                            <option value="0800">08:00HR</option>
                                            <option value="0900">09:00HR</option>
                                            <option value="1000">10:00HR</option>
                                            <option value="1100">11:00HR</option>
                                            <option value="1200">12:00HR</option>
                                            <option value="1300">13:00HR</option>
                                            <option value="1400">14:00HR</option>
                                            <option value="1500">15:00HR</option>                
                                        </select>
                                       
                                            <?php echo "<input type ='hidden' name='r_ID' id='r_ID' value ='"?><?php echo $data['r_ID']; ?> <?php echo "'/>" ?>
                                            <button type='Submit' class="bookingbutton"><i class="fa-regular fa-circle-down"></i> Book Now!</button>
                                    </form>
                                    
            </div>	 
	</div>
                  <?php
        $sn++;}
        } else { 
        ?>
        <div class="view_item">
            <errortext>No Rooms Currently Launched! <i class="fa-solid fa-face-sad-tear"></i><br>Check again with a UOW Staff Member.</errortext>
        <?php } ?>             
        </div>
</div>
</body>
</html>
