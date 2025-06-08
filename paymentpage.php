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
    $r_price = $_POST["r_sumprice"];
    $roomname = $_POST["roomname"];
    $rb_starttime = $_POST["rb_starttime"];
    $rb_endtime = $_POST["rb_endtime"];
    $r_date = $_POST["r_date"];
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/loadingstyle.css">
<link rel="stylesheet" href="css/welcome.css">

<link rel="stylesheet" href="css/paymentpagestyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
</head>
<body>
    <header class="header">
            <div class="logo"><a href="sols_login_ctl.login"></a><img src="images/logo_uow.png" height="45px" alt="University of Wollongong Logo">
          
            </div>
          
            <nav class="navbar">
                <a href="StudentPage.php"><i class="fa-solid fa-house"></i> Home</a>
                <a href="StudentBookingofRooms.php"><i class="fa-solid fa-magnifying-glass"></i> Book a Room</a>
                <a href="StudentBookingofRoomsDisplay.php"><i class="fa-solid fa-clipboard-check"></i> My Bookings</a>
                <a href="HelpPage.html" target="_blank"><i class="fa-solid fa-circle-question"></i> Help</a>
                <a href="StudentLogin.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a>
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

<h2>Checkout Page</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form name=paymentform action="paymentpage_backend.php" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> Country</label>
            <input type="text" id="city" name="city" placeholder="Singapore">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="Singapore">
              </div>
              <div class="col-50">
                <label for="zip">Postal Code</label>
                <input type="text" id="zip" name="zip" placeholder="123456">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Payment Methods</label>
            <div class="icon-container">
              <i class="fa-brands fa-cc-visa" style="color:navy;"></i>
              <i class="fa-brands fa-cc-amex" style="color:blue;"></i>
              <i class="fa-brands fa-cc-mastercard" style="color:red;"></i>
              <i class="fa-brands fa-cc-discover" style="color:orange;"></i>
              <i class="fa-brands fa-paypal" style="color:#253B80;"></i>
              <i class="fa-brands fa-google-pay" style="color:#5F6368;"></i>
              <i class="fa-brands fa-apple-pay" style="color:black;"></i>
              <i class="fa-brands fa-amazon-pay" style="color:#333E47;"></i>
              
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="December">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2023">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="000">
                
                <input type="hidden" name="r_ID"     id="r_ID"     value="<?=$r_ID?>" />
                <input type="hidden" name="r_booked" id="r_booked" value="<?=$r_booked?>"/>
                <input type="hidden" name="r_price"  id="r_price"  value="<?=$r_price?>" />
                <input type="hidden" name="roomname" id="roomname" value="<?=$roomname?>"/>
                <input type="hidden" name="r_date" id="r_date" value="<?=$r_date?>"/>
                <input type="hidden" name="rb_starttime" id="rb_starttime" value="<?=$rb_starttime?>"/>
                <input type="hidden" name="rb_endtime" id="rb_endtime" value="<?=$rb_endtime?>"/>
                
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
          <button type="submit" value="Pay Now" class="btn"><i class="fa-solid fa-money-check-dollar"></i> Pay Now</button>
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4>
      <br>
      <p><?=$roomname?> ( <b><?=$r_date?></b> )<br> @ <?=$rb_starttime?> HRS to <?=$rb_endtime?> HRS<span class="price" style="color:black">$<?=$r_price?></span></p>
      <br>
      <hr>
      <br>
      <p>Total <span class="price" style="color:black"><b>$<?=$r_price?></b></span></p>
    </div>
  </div>
</div>
  

</body>
</html>