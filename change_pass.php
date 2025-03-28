<?php 
require_once 'config.php';
if(session_status()== PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['user_email_address'])){
    echo "<script>alert('You have to first Log In/Sign Up!');
    window.location.href = 'auth.php';
    </script>";
    exit();
}
if(!isset($_SESSION['forget']))
$_SESSION['change'] = true;

if(isset($_POST['submitpass']) && isset($_POST['npass'])){
    $newpass = $_POST['npass'];
        $_SESSION['otp'] = rand(100000, 999999);
        //echo $newpass . "<br\>";
        $password = password_hash(trim($newpass), PASSWORD_BCRYPT);
        //echo $password;
        $sql = "UPDATE `users` SET `password`='$password' WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$_SESSION['user_email_address']);
        $stmt->execute();
        //unset($_SESSION['change']);
        header('Location: verify_otp.php');
}
else{
    header("Location:index.php");
    exit();
}
?>