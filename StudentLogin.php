<!DOCTYPE html>
<html>    
<head>
        <title>SIM Room Booking System</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="css/welcome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       
</head>
<body>
    <div class="header">
            <div class="logo"><a href="sols_login_ctl.login"></a><img src="images/logo_uow.png" height="45px" alt="University of Wollongong Logo">
          
            </div>
          
            
            
            
            <nav class="navbar">
                <a href="HelpPage.html" target="_blank"><i class="fa-solid fa-circle-question"></i> Help</a>
            </nav>
        </div>

    
<?php
// define variables and set to empty values
$s_username = $s_password = "";
$nameErr = $passwordErr = "";

// Function to sanitize user input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["s_username"])) {
        $nameErr = "Name is required!";
    } else {
        $s_username = sanitize_input($_POST["s_username"]);
    }

    // Validate password
    if (empty($_POST["s_password"])) {
        $passwordErr = "Password is required!";
    } else {
        $s_password = sanitize_input($_POST["s_password"]);
        }
    }
?>    
   
<h1 style="text-align: center; color:#ffffff"><u>Student Login (For booking of rooms)</u></h1>

<img src="images/simlogo.png" alt="SIM" class="center"><!-- comment -->





<form method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <fieldset class="center">
        <legend><b><h2><i class="fa-solid fa-graduation-cap"></i> Student Login</h2></b></legend>
        <div>
            <label for="name"><b>Username:</b></label> 
            <input type="text" placeholder="Username" name="s_username">
            <span style="color: red;"><?php echo $nameErr; ?></span>
        </div>
    <br>
        <div>
            <label for="password"><b>Password:</b></label>
            <input type="password" placeholder="Password" name="s_password">
            <span style="color: red;"><?php echo $passwordErr; ?></span>
        </div>
        
        
    <br><br>
        
    <button type="submit" class="buttonstyle1">Login</button><!-- comment -->
    <button type="button" class="buttonstyle1" onclick="location.href='RegisterPage.php'">Sign Up </button><!-- comment -->
    <br><br>
        
    <a href="StaffLogin.php" style="float: right;">Go to Staff Login</a><br><!-- comment -->
    </fieldset>
</form>


<!-- backend --------------------------------------------------------------------------------->
<?php
// Display the submitted data if it's valid
if (!empty($s_username) && !empty($s_password) ) {
    $s_username = $_POST["s_username"];
    $s_password = $_POST["s_password"];
    
    $conn=new mysqli("localhost","root","","bs_useraccounts");

    $stmt = $conn->prepare("SELECT * FROM tb_users WHERE s_username=? and s_password=?");
    
    $stmt -> bind_param("ss", $s_username, $s_password);
    $stmt -> execute();

    $stmt -> store_result();
    $row = $stmt -> num_rows();
    $stmt -> bind_result($UID, $s_firstname, $s_lastname, $s_email, $s_username, $s_password, $ADMIN);

    $stmt -> fetch();
    $stmt -> close();

    if($row == 0){
        echo '<script language="javascript">';
        echo 'alert("Wrong username/password!");';
        echo 'window.location="StudentLogin.php";';
        echo '</script>';
    }
    else if($ADMIN == 1){
        echo '<script language="javascript">';
        echo 'alert("Wrong username/password!");';
        echo 'window.location="StudentLogin.php";';
        echo '</script>';
    }
    else {
        echo "success";
        session_start();
        $_SESSION["UID"] = $UID;
        $_SESSION["ADMIN"] = $ADMIN;
        $_SESSION["s_name"] = $s_firstname;
        $_SESSION["s_username"] = $s_username;
        header("Location: StudentPage.php");
    }
}
?>  

</body>

</html>

