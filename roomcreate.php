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
?>
<html>
    <head>
        <title>Create Room</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="css/welcome.css">
        <link rel="stylesheet" href="css/tablestyling.css">
        <link rel="stylesheet" href="css/roomcreatestyle.css">
        <link rel="stylesheet" href="css/loadingstyle.css">
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

<?php
$roomname = $roomsize = $r_price = "";
$roomnameErr = $roomsizeErr = $r_priceErr = "";

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["roomname"])) {
        $roomnameErr = "Room Name is required!";
    }else{ 
        $roomname = sanitize_input($_POST["roomname"]);
    }
    // Validate size
    if (empty($_POST["roomsize"])) {
        $roomsizeErr = "Please enter a number!";
    }else if(!is_numeric($_POST["roomsize"])){
        $roomsizeErr = "Only numbers allowed!";
    }else{
        $roomsize = sanitize_input($_POST["roomsize"]);
    }
    if (empty($_POST["r_price"])) {
        $r_priceErr = "Please enter a number!";
    }else if(!is_numeric($_POST["r_price"])){
        $r_priceErr = "Only numbers allowed!";
    } else {
        $r_price = sanitize_input($_POST["r_price"]);
    }
} 
?>
        <fieldset>
            <h1><u>Create A Room</u></h1>
            <br>            
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
            <label>Enter Room Name :</label>
            <input type="text" name="roomname">
            <span style="color: red;"><?php echo $roomnameErr; ?></span>
            
            <br>
            
            <label>Enter Room Size :</label>
            <input type="text" name="roomsize"> pax
            <span style="color: red;"><?php echo $roomsizeErr; ?></span>
            
            <br>
            
            <label>Enter Room Rrice : $</label>
            <input type="text" name="r_price"> /hr
            <span style="color: red;"><?php echo $r_priceErr; ?></span>
            
            <br>
            
            <button type="button" class="launchbutton" onclick="window.history.back()"><i class="fa-solid fa-arrow-left"></i> Back</button>
            <button type="submit" class="launchbutton1" style="float:right"><i class="fa-solid fa-check"></i> Create</button>
            

        </form>
            
        </fieldset>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($roomnameErr) && empty($roomsizeErr) && empty($r_priceErr)){
        $roomname = $_POST["roomname"];
        $roomsize = $_POST["roomsize"];
        $r_price  = $_POST["r_price"];
  
    $conn=new mysqli("localhost","root","","bs_useraccounts"); 
    
    $sql="select * from tb_rooms where (roomname='$roomname');";

    $res=mysqli_query($conn,$sql);

      if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        if($roomname==isset($row['roomname']))
        {
            echo '<script language="javascript">';
            echo 'alert("Roomname already exists!");';
            echo 'window.location="roomcreate.php";';
            echo '</script>';
        }
        
        }else{
            echo '<script language="javascript">';
            echo 'alert("Success!");';
            echo 'window.location="StaffLaunchingofRooms.php";';
            echo '</script>';
            $conn=new mysqli("localhost","root","","bs_useraccounts");  
            $stmt=$conn->prepare("insert into tb_rooms (roomname, roomsize, r_price) values (?,?,?)");
            $stmt->bind_param("sss",$roomname,$roomsize,$r_price);
            $stmt->execute();
            $stmt->close();
            $conn->close();

        }
    }
}
?>

    </body>

</html>
