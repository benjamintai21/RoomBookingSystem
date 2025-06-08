<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main1.css">
    <link rel="stylesheet" href="css/welcome.css">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       
</head>
<body>
    
<?php
// define variables and set to empty values
$susername = $semail = $sfirstname = $slastname = $spassword = "";
$usernameErr = $emailErr = $firstErr = $lastErr = $passwordErr = $regSuccess = "";

// Function to sanitize user input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["susername"])) {
        $usernameErr = "* Username is required!";
    } else {
        $susername = sanitize_input($_POST["susername"]);
    }    
    if (empty($_POST["semail"])) {
        $emailErr = "* Email is required";   
    } else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",($_POST["semail"]))){
        $emailErr = "* Invalid Email Format";
    } else {
        $semail = sanitize_input($_POST["semail"]);
    }
    if (empty($_POST["sfirstname"])) {
        $firstErr = "* First Name is required!";
    } else {
        $sfirstname = sanitize_input($_POST["sfirstname"]);
    }
    if (empty($_POST["slastname"])) {
        $lastErr = "* Last Name is required!";
    } else {
        $slastname = sanitize_input($_POST["slastname"]);
    }
    if (empty($_POST["spassword"])) {
        $passwordErr = "* Password is required!";
    } else {
        $spassword = sanitize_input($_POST["spassword"]); 
    }
    
    
}
?>   
    <header class="header">
        <div class="logo"><a href="sols_login_ctl.login"></a><img src="images/logo_uow.png" height="45px" alt="University of Wollongong Logo">
          
            </div>
          
            
            
            
            <nav class="navbar">
                <a href="HelpPage.html" target="_blank"><i class="fa-solid fa-circle-question"></i></span> Help</a>
            </nav>
        </div>
    </header>
<div class="formbox1 background-tint">
    <div class="background-tint"></div>
    <div class="lowerform"></div>
        <form  method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
        <fieldset>
                
                <div class="Register title">
                    <strong>REGISTER</strong>
                </div>
                
        <label for="sfirstname"><b>First Name:</b></label> 
        <input type="text" placeholder="First Name" name="sfirstname" value="<?php echo $sfirstname;?>">
        <span style="color: red;" class="error"> <?php echo $firstErr; ?></span>
        
        <br><br><!-- First Name -->
        
        <label for="slastname"><b>Last name:</b></label>
        <input type="text" placeholder="Last Name" name="slastname" value="<?php echo $slastname;?>">
        <span style="color: red;" class="error"> <?php echo $lastErr; ?></span>
        
        <br><br><!-- Last Name -->
        
        <label for="semail"><b>Email:</b></label>
        <input type="text" placeholder="Email Address" name="semail" value="<?php echo $semail;?>">
        <span style="color: red;" class="error"> <?php echo $emailErr; ?></span>
        
        <br><br><!-- email -->
              
        
        <label for="susername"><b>Username:</b></label> 
        <input type="text" placeholder="Username" name="susername" value="<?php echo $susername;?>">
        <span style="color: red;" class="error"> <?php echo $usernameErr; ?></span>
       
        <br><br><!<!-- username -->
        
        <label for="spassword"><b>Password:</b></label> 
        <input type="password" placeholder="Password" name="spassword" pattern=[a-zA-Z0-9]{8,} value="<?php echo $spassword?>"> (Please use at least 8 alphanumeric characters)
        <span style="color: red;" class="error"> <?php echo $passwordErr; ?></span>
        
        <br><br><!-- password -->
        <input type="submit" name="submit" value="SIGN UP" class="button_r">
        
        
        <a href="StudentLogin.php" class="l_link">Return to Login Page</a><br>
        
        <br><br><!-- comment -->
        
        <span style="color: Green;" class="error"> <?php echo $regSuccess; ?></span>
        
        </fieldset>
</form>
    </div>
<?php
// Display that account has been submitted submitted succesfully and submitted to SQL
if (!empty($susername) && !empty($sfirstname) && !empty($slastname) && !empty($semail) && !empty($spassword)) {    
    $susername=$_POST["susername"];
    $semail=$_POST["semail"];
    $sfirstname=$_POST["sfirstname"];
    $slastname=$_POST["slastname"];
    $spassword=$_POST["spassword"];
    
    
    
    $conn=new mysqli("localhost","root","","bs_useraccounts"); 
    
    $sql="select * from tb_users where (s_username='$susername');";

      $res=mysqli_query($conn,$sql);

      if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        if($susername==isset($row['s_username']))
        {
            echo '<script language="javascript">';
            echo 'alert("Username already exists!");';
            echo 'window.location="RegisterPage.php";';
            echo '</script>';
        }
        
        }else{
            echo '<script language="javascript">';
            echo 'alert("Success!");';
            echo 'window.location="StudentLogin.php";';
            echo '</script>';
            $stmt=$conn->prepare("insert into tb_users (s_username,s_email,s_firstname,s_lastname,s_password) values (?,?,?,?,?)");
            $stmt->bind_param("sssss",$susername,$semail,$sfirstname,$slastname,$spassword);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            
        }
      }         
?>
    


</body>
</html>


