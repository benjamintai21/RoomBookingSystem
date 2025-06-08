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

$conn=new mysqli("localhost","root","","bs_useraccounts");

$stmt = $conn->prepare("SELECT * FROM tb_codes");
$stmt -> execute();
$stmt -> store_result();
$row = $stmt -> num_rows();
$stmt -> bind_result($p_ID, $p_code, $discount);
$stmt -> execute();
$result = $stmt->get_result(); 

?>
<html>
    <head>
        <title>Promo Code</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="css/welcome.css">
        <link rel="stylesheet" href="css/tablestyling.css">
        <link rel="stylesheet" href="css/roomcreatestyle.css">
        <link rel="stylesheet" href="css/loadingstyle.css">
        <link rel="stylesheet" href="css/PromoCodeStyle.css">
        
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
                <a href="StaffPage.php"><i class="fa-solid fa-house"></i> Home</a>
                <a href="StaffLaunchingofRooms.php"><i class="fa-solid fa-magnifying-glass"></i> Manage Rooms</a>
                <a href="HelpPage.html" target="_blank"><i class="fa-solid fa-circle-question"></i> Help</a>
                <a href="LogoutStaff.php"><i class="fa-solid fa-right-from-bracket" ></i> Sign Out</a>
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
            <h1><u>Promo Codes</u></h1>
            <br>            
        
<table border="2" cellspacing="0" cellpadding="10">
  <tr>
    <th>ID</th>
    <th>Promo Code</th>
    <th>Discount</th>
    <th>Activate</th>
  </tr>
<?php
if ($result->num_rows > 0 ) {
  $sn=1;
  while($data = $result->fetch_assoc()) {
 ?>
  <tr>
   <td><?php echo $data['p_id']; ?> </td>
   <td><?php echo $data['p_code']; ?> </td>
   <td><?php echo $data['discount']; ?> % </td>

   <td> 
       <form onsubmit="return confirm('Do you really want to delete this code, this cannot be undone!');" action='promocodedelete_backend.php' method='post'>
                    <?php echo "<input type ='hidden' name='p_id' value ='"?><?php echo $data['p_id']; ?> <?php echo "'/>" ?>
                    <?php echo "<input type ='hidden' name='p_code' id='p_code' value ='"?><?php echo $data['p_code']; ?> <?php echo "'/>" ?>
                    <?php echo "<input type ='hidden' name='discount' id='discount' value ='"?><?php echo $data['discount']; ?> <?php echo "'/>" ?>
                <button type='Submit' class="roombuttons"><i class="fa-solid fa-trash"></i> Delete</button>
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
     <td colspan="4">No Promo Codes Have Been Added</td>
    </tr>
    
<?php } ?>
    </table>  
            
        <button type="button" class="launchbutton" onclick="location.reload()"><i class="fa-solid fa-rotate-right"></i></button>        
    
        <button type="button" class="launchbutton" style="float: right;" onclick="location.href='StaffPromoCodeCreate.php'"><i class="fa-solid fa-plus"></i> Add Promo Code</button>
        
        </fieldset>

    </body>
</html>

