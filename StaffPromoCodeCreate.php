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
$p_code = $discount = "";
$p_codeErr = $discountErr = "";

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["p_code"])) {
        $p_codeErr = "Code is required!";
    }else{ 
        $p_code = sanitize_input($_POST["p_code"]);
    }
    // Validate size
    if (empty($_POST["discount"])) {
        $discountErr = "Please enter a number!";
    }else if(!is_numeric($_POST["discount"])){
        $discountErr = "Only numbers 1-100 allowed!";
    }else{
        $discount = sanitize_input($_POST["discount"]);
    }
} 
?>
        <fieldset>
            <h1><u>Add Promo Code</u></h1>
            <br>            
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
            <label>Enter Promo Code :</label>
            <input type="text" name="p_code">
            <span style="color: red;"><?php echo $p_codeErr; ?></span>
            
            <br>
            
            <label>Enter Discount :</label>
            <input type="number" name="discount"> %
            <span style="color: red;"><?php echo $discountErr; ?></span>
            
            <br>
            
            <button type="button" class="launchbutton" onclick="location.href='StaffPromoCode.php'"><i class="fa-solid fa-arrow-left"></i> Back</button>
            <button type="submit" class="launchbutton1" style="float:right"><i class="fa-solid fa-check"></i> Create</button>
            

        </form>
            
        </fieldset>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($p_codeErr) && empty($discountErr)){
        $p_code = $_POST["p_code"];
        $discount = $_POST["discount"];
        
    $conn=new mysqli("localhost","root","","bs_useraccounts"); 
    
    $sql="select * from tb_codes where (p_code='$p_code');";

    $res=mysqli_query($conn,$sql);

      if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        if($p_code==isset($row['p_code']))
        {
            echo '<script language="javascript">';
            echo 'alert("Code already exists!");';
            echo 'window.location="StaffPromoCodeCreate.php";';
            echo '</script>';
        }
        
        
        }else{
            echo '<script language="javascript">';
            echo 'alert("Successfully created!");';
            echo 'window.history.back();';
            echo '</script>';
    
            $conn=new mysqli("localhost","root","","bs_useraccounts");  
            $stmt=$conn->prepare("insert into tb_codes (p_code, discount) values (?,?)");
            $stmt->bind_param("ss",$p_code,$discount);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
            
    }

}
?>

    </body>

</html>
