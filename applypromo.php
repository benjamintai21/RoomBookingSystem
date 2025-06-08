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
$r_booked = $_POST["r_booked"];
$r_price=$_POST["r_price"];
$roomname=$_POST["roomname"];
$r_date=$_POST["r_date"];
$r_starttime=$_POST["r_starttime"];
$r_endtime=$_POST["r_endtime"];
$rb_starttime=$_POST["rb_starttime"];
$rb_endtime=$_POST["rb_endtime"];


$conn = new mysqli("localhost","root","","bs_useraccounts");
$stmt = $conn -> prepare("SELECT * FROM tb_rooms WHERE r_ID = ?");
$stmt -> bind_param("s",$r_ID,);

$stmt -> bind_result($r_ID, $roomname, $r_launch, $roomsize, $r_price,$r_date ,$r_starttime,$r_endtime, $r_booked,$rb_starttime,$rb_endtime, $UID);

$stmt -> execute();


$result = $stmt->get_result();


$stmt -> close();
$conn -> close();
?>
<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="css/loadingstyle.css">
        <link rel="stylesheet" href="css/collapsible.css"><!-- comment -->
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
                <a href="LogoutStudent.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a>
            </nav>
        </header>
<?php
// define variables and set to empty values
$p_code = "";
$p_codeErr = $p_codeSuccess = $p_applied = "";

$r_hrs =(($rb_endtime- $rb_starttime) / 100);
$r_sumprice = $r_price * $r_hrs;


// Function to sanitize user input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["p_code"])) {
        $p_codeSuccess = "Got a discount code?";
    } else {
        $p_code = sanitize_input($_POST["p_code"]);
        $conn=new mysqli("localhost","root","","bs_useraccounts");

        $stmt = $conn->prepare("SELECT * FROM tb_codes WHERE p_code = ?");
    
        $stmt -> bind_param("s", $p_code);
        $stmt -> execute();

        $stmt -> store_result();
        $row = $stmt -> num_rows();
        $stmt -> bind_result($p_ID, $p_code, $discount);

        $stmt -> fetch();

        if($row == 1){
            $r_price = $r_price * ((100 - $discount) / 100);
            $p_codeSuccess = "Succesfully applied!";
            $p_applied = "Order discount : $discount% off";
            $r_sumprice = $r_price * $r_hrs;
                          
        }else{
            $p_codeErr = "Invalid discount code!";
        }
    }
}
?>    
<div class="loader"></div>
<script>
  window.addEventListener("load", () => {     
       
  document.querySelector(".loader").classList.add("loader--hidden");
  document.querySelector(".loader").addEventListener("transitionend", () => {
  document.body.removeChild(document.querySelector(".loader"));
  });
});
</script>
<?php 

?>

        <div class="container">
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
                                        <h2 class="title"><i class="fa-regular fa-building"></i> <?php echo $data['roomname']; ?> <i class="fa-solid fa-calendar-days"></i> Date: <?=$r_date?></h2>
                                        <br>
                                        
			
  
                <div class="form-style-6">
                <form action="" method="post">
                    <input type="hidden" name="r_date"         id="r_date"       value="<?=$r_date?>" />
                    <input type="hidden" name="r_starttime"    id="r_starttime"  value="<?=$r_starttime?>" />
                    <input type="hidden" name="r_endtime"      id="r_endtime"    value="<?=$r_endtime?>" />
                    <input type="hidden" name="rb_starttime"   id="rb_starttime" value="<?=$rb_starttime?>" />
                    <input type="hidden" name="rb_endtime"     id="rb_endtime"   value="<?=$rb_endtime?>" />
                    <input type="hidden" name="r_ID"           id="r_ID"         value="<?=$r_ID?>" />
                    <input type="hidden" name="r_booked"       id="r_booked"     value="<?=$r_booked?>"/>
                    <input type="hidden" name="r_price"        id="r_price"      value="<?=$r_sumprice?>" />
                    <input type="hidden" name="r_hrs"          id="r_hrs"        value="<?=$r_hrs?>" />
                    <input type="hidden" name="roomname"       id="roomname"     value="<?=$roomname?>"/>
                    <input type="hidden" name="r_price"        id="r_price"      value="<?=$r_price?>" />
                    
                    
                    
                    <div class="paymentdiv">
                        <h3><i class="fa-solid fa-clock"></i> Your Time Slot: <?=$rb_starttime?> HRS to <?=$rb_endtime?> HRS</h3>
                    </div>
                    <br>
                    
                    <div class="paymentdiv">
                        
                        <label><i class="fa-solid fa-dollar-sign"></i> Subtotal: </label>
                        <input type="text" value="$<?=$r_price?> x <?=$r_hrs?>hr(s) = $<?=$r_sumprice?>" readonly>
                        <h4 id="p_applied"><?php echo $p_applied; ?></h4>
                    </div>
                    <br>
                    
                    <div class="paymentdiv"><label><i class="fa-solid fa-tags"></i></label>
                        <input type="text"   name="p_code" id="p_code" placeholder="Discount code or gift card" value="">
                        <button type="submit" class="launchbutton2">Apply</button>
                        <span1 style="color: red;" id="p_codeErr"><?php echo $p_codeErr; ?></span1>
                        <span1 style="color: green;"><?php echo $p_codeSuccess; ?></span1>
                    </div>
                    
                    <hint>*Use code 'TERENCE' for a HUGE discount!</hint>
                </form>
                    
                <form action="paymentpage.php" method="post">
                    <input type="hidden" name="r_date"         id="r_date"       value="<?=$r_date?>" />
                    <input type="hidden" name="r_starttime"    id="r_starttime"  value="<?=$r_starttime?>" />
                    <input type="hidden" name="r_endtime"      id="r_endtime"    value="<?=$r_endtime?>" />
                    <input type="hidden" name="rb_starttime"   id="rb_starttime" value="<?=$rb_starttime?>" />
                    <input type="hidden" name="rb_endtime"     id="rb_endtime"   value="<?=$rb_endtime?>" />
                    <input type="hidden" name="r_ID"           id="r_ID"         value="<?=$r_ID?>" />
                    <input type="hidden" name="r_booked"       id="r_booked"     value="<?=$r_booked?>"/>
                    <input type="hidden" name="r_sumprice"     id="r_sumprice"   value="<?=$r_sumprice?>" />
                    <input type="hidden" name="r_hrs"          id="r_hrs"        value="<?=$r_hrs?>" />
                    <input type="hidden" name="roomname"       id="roomname"     value="<?=$roomname?>"/>
                    <input type="hidden" name="r_price"        id="r_price"      value="<?=$r_price?>" />
                    
                    
                        <a class="buttona">
                            <button type="submit" class="hugeassbutton"><i class="fa-solid fa-cart-shopping"></i><ii> Go to Checkout</ii></button>
                        </a>
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
    </body>
</html>
    
    

