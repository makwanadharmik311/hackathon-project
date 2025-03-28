<?php
//echo "Google User!!";

//Include Configuration File
require_once 'con1.php';
require_once 'config.php';

// if(!isset($_SESSION['access_token'])){
//     $authUrl = $google_client -> createAuthUrl();
//     header("Location:" . $authUrl);
//     exit;
// }
if(isset($_GET["code"]))
{
 
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
   } 
   $_SESSION['google_id'] = true;
  
 $email = $_SESSION["user_email_address"];
 $email = trim($email);
 $query = "SELECT * FROM  `users` where email = '$email'";
 $res = mysqli_query($conn,$query);
 $row = mysqli_fetch_assoc($res);
 $num = mysqli_num_rows($res);
 //echo $email . "  " ;
 $sign_up = false;
 //print_r($res);
 if($num == 1){
    //echo $row['role'] . "<br>";
    $_SESSION["user_id"] = $row['id'];
    $_SESSION["role"] = $row['role'];
    $_SESSION['otp'] = rand(100000, 999999);
    header("Location:verify_otp.php");
    exit(); 
 }
 else{
      echo "<script>alert('Hello');</script>";
      $sign_up = true;
 }
}
// else{
//    // session_start();
//     //session_destroy();
//     //echo $token['error'];
//     echo '<script>alert("Session Expired!! Please Login Again!!")</script>';
// }

}
else
   {
    echo '<script>alert("Authentication Failed!!")</script>';
   }
/*
if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
} */

?>
   <?php
   if(isset($_POST["SignUp1"])){
    echo "<script>alert('Hello');</script>";
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $_SESSION["role"] = isset($_POST['role']) ? $_POST['role'] : 'COLLECTOR'; 
    $name = $_SESSION["user_name"] . " " . $_SESSION['user_last_name'];
    
    $stmt = $conn->prepare('INSERT INTO `users` (name, email, password, role) VALUES (?, ?, ?, ?)');
    

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $_SESSION['user_email_address'], $password, $_SESSION["role"]);
   
    if ($stmt->execute()) {
        // if(isset($_SESSION['user_image'])){
        //     $user_email =  $_SESSION['user_email_address'];
        //     $imagePath = "";
        //     if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK){
        //         $uploadDir = "uploads/";
        //         $fileName = basename($_FILES['profile_image']['name']);
        //     }
        //   }
        // Redirect based on role after successful registration
        // if(isset($_SESSION['user_image'])){
        // $image = $_SESSION['user_image'];
        // $sql1 = "UPDATE `users` SET `profile_picture`='$image' WHERE email = ?";
        // $stmt1 = $conn->prepare($sql1);
        // $stmt1->bind_param("s",$_SESSION['user_email_address']);
        // $stmt1->execute();
        //}
        $query = "SELECT id FROM  `users` where email = '$email'";
        $res = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($res);
        $_SESSION["user_id"] = $row['id'];

        $_SESSION['otp'] = rand(100000, 999999);
        echo "<script>window.location.href = 'verify_otp.php';
        </script>";
        exit();
        // if ($role == "ADMIN") {
        //     header("Location: admin_dashboard.php");
        // } else {
        //     header("Location: index.php");
        // }
        // exit;
    } else {
        // Log and display error if execution fails
        error_log("Insert Error: " . $stmt->error);
        die("Error inserting data: " . $stmt->error);
    }

    // Close statement & connection
    $stmt->close();
    $stmt1->close();
    $conn->close();
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/auth.css"> -->
    <title>Sign Up</title>
</head>
<body style = "text-align : center;background: url('./assets/images/bg4.jpg') no-repeat center center fixed;
    background-size: cover;
    color: black;
    overflow-x: hidden;
    overflow-y: auto;">
<div>
            <form id="signup-form" method="post" onsubmit = "return checkPassword()"> 
                <h2 style = 'text-align : center;font-size : 25px; font-family : Century Gothic;'>You have to enter your password in order to create account : </h2>
                <!-- <div class="social-icons">
                   <a href=" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                   <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div> -->
                <!--<span id="signup-or">or use your email for registration</span> -->

                <!-- <input type="text" id="signup-name" name="name" placeholder="Name" required> -->

                <!-- <input type="email" id="signup-email" name="email" placeholder="Email" required> -->
                <div class="password-container">
                    <input type="password" id="signup-password" name="password" placeholder="Password" required>
                    <i class="fa-solid fa-eye" onclick="togglePassword('signup-password', this)"></i>
                </div>

                <!-- Role Dropdown -->
                <select name="role" id="signup-role" required>
                    <option value="">Select Role</option>
                    <option value="ARTISAN">Artisan</option>
                    <option value="COLLECTOR">Collector</option>
                    <option value="INSTITUTION">Institution</option>
                    <option value="ADMIN">Admin</option>
                </select>

                <button type="submit" name="SignUp1" id="signup-button" value="SignUp">Sign Up</button>
            </form>
            <script>
                function checkPassword(){
                    let password = document.getElementById("signup-password").value;
                    if(validatePassword(password)){
                        alert("✅ Password is valid!");
                        return true;
                    }

                    else{
                        alert("❌ Password must contain an uppercase, lowercase, number, special character, and be at least 6 characters long.");
                        return false; // Prevent form submission
                    }
                }
                </script>
        </div>
        <script src="assets/js/validation.js"></script>

</body>
</html>
<!--
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login using Google Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
 </head>
 <body>
  <div class="container">
   <br />
   <h2 align="center">PHP Login using Google Account</h2>
   <br />
   <div class="panel panel-default">
    
   /*
   if($login_button == '')
   {
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else
   {
    echo '<script>alert("Authentication Failed!!")</script>';
   */

   </div>
  </div>
 </body>
</html>
-->