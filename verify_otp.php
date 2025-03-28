<?php
require_once 'config.php';
require_once 'send_email.php';
if(session_status()== PHP_SESSION_NONE){
    include_once 'includes/sessionStart.php';
}

$error =  "";


if(isset($_POST["submitotp"])){
    $entered_otp = $_POST['otp'];
    //echo $entered_otp;
    if($entered_otp == $_SESSION['otp']){
          unset($_SESSION['otp']);
          if($_SESSION['change']){
          unset($_SESSION['change']);
          echo "<script>alert('Password Changed Successfully.!');</script>";
          echo "<script>window.location.href = 'http://localhost/php_e-commerce/profile.php';</script>";
          }
    if(isset($_SESSION['forget']))
    echo "<script>alert('Please save the Password for further use!');</script>";
        if ($_SESSION["role"] === "ADMIN") {
            echo "<script>window.location.href = 'http://localhost/php_e-commerce/index.php';</script>";
            } else {
                echo "<script>window.location.href = 'http://localhost/php_e-commerce/index.php';</script>";
            }
            exit;
        }
        else{
            $error = "Invalid OTP! Try Again!!";
        }
    }

if(!isset($_SESSION['user_email_address'])){
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
    <style>
        body{font-family : Arial, sans-serif; text-align: center;}
        form{display: inline-block; padding: 20px; border: 1px solid #ccc; }
        input{display:block; margin:10px auto; padding: 10px; width: 80%;}
        h2{font-size: 25px; font-family: Sans-Serif;}
        .error{color:red; font-size: 25px; font-family: Sans-Serif;}
    </style>
        
</head>
<body>
    <?php $button = isset($_SESSION['change']) ? 'Change' : 'Submit OTP'; ?>
    <h2>Enter OTP which is sent on your registered E-Mail I'D</h2>
    <form method = "POST">
        <input type = "number" name = "otp" placeholder = "Enter OTP" required>
        <input type = "submit" name = "submitotp" value = "<?php echo $button; ?>">
    </form>
    <p class = "error"><strong><?php echo $error ?></strong></p>
    
</body>
</html>