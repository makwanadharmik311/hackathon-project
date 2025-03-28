<?php
if(session_status()== PHP_SESSION_NONE){
    session_start();
}

echo "<script>console.log('Sending E-Mail...');</script>";
if(!isset($_SESSION['user_email_address']) and !isset($_SESSION['otp'])){
    header('Location:index.php');
    exit();
}

require_once 'vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);
$otp =  $_SESSION['otp'];
$subject = "OTP for Authentication in Tribals Arts & Crafts Website";
$body = "<p>Your OTP is :  <strong>$otp</strong></p><br><p>Don't Send it with anyone..!</p>";

try{
    $mail->isSMTP();
    //$mail->SMTPDebug = 3;
    //$mail->Debugoutput = 'html';
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rushichaubal6@gmail.com';
    $mail->Password = 'ryrhtaghwjzheepq';   
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('rushichaubal6@gmail.com','Rushi Chuabal');
    $mail->addAddress($_SESSION['user_email_address'],'Receipient');

    $mail->isHtml(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    //$mail->Body = '<h1>Hello!</h1><p>This is a test email sent using <b>PHPMailer</b> and <b>SendGrid</b>.</p>';
    $mail->AltBody = 'Hello! This is a test email sent using PHPMailer and SendGrid.';

    if($mail->send()){
        echo "Email Sent Successsfully!";
    }

}
catch(Exception $e){
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>

