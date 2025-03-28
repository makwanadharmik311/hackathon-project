<?php
if(session_status()== PHP_SESSION_NONE){
    include_once 'includes/sessionStart.php';
}
if(!isset($_SESSION['user_email_address'])){
    echo "<script>alert('You have to first Log In/Sign Up!');
    window.location.href = 'auth.php';
    </script>";
    exit();
  }
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload an Image</title>
</head>
<body style="background: url('./assets/images/bg4.jpg') no-repeat center center fixed;
    background-size: cover;
    color: black;
    overflow-x: hidden;
    overflow-y: auto;">
    
    <form id = "upload-form" action = "upload.php" method = "POST" enctype = "multipart/form-data" style="text-align:center;">
        <input type = "file" name = "profile_image" accept = "image/*" style="transform:scale(1.7);transform-origin:left;padding:10px;margin:25px;margin-bottom:4px;" required><br>
        <small style = 'font-family:Century Gothic; font-size:17px;'>(Allowed JPEG, JPG, GIF or PNG. Max size of 800KB)</small><br>
        <input type = "submit" value = "Upload" style="font-size:27px;padding:10px;margin:34px;">
    </form>
    


<?php 
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_FILES["profile_image"])){
    $userEmail = $_SESSION['user_email_address'];
    $uploadDir = "uploads/";
    if(!is_dir($uploadDir)){
        mkdir($uploadDir,0777,true);
    }

    $fileName = basename($_FILES["profile_image"]["name"]);
   
    //echo $targetFile;
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    $maxFileSize = 800*1024;

    if(!in_array($_FILES["profile_image"]["type"],$allowedTypes)){
        echo "<script>alert('Invalid File Type!!');
        window.location.href = './profile.php';
        </script>";
        exit();
     }
    if($_FILES["profile_image"]["size"] > $maxFileSize){
        echo "<script>alert('File is too Large!\nMax allowed Size : 10MB');
        window.location.href = './profile.php';
        </script>";
        exit();
    }

    $targetFile = $uploadDir . uniqid() . "_" . $fileName;
    //To delete Old Image
    $sql = "SELECT profile_picture FROM users WHERE `email` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $oldImage = $row['Image'] ?? null;

    //Move New File
    if(move_uploaded_file($_FILES["profile_image"]["tmp_name"],$targetFile)){
        $sql = "UPDATE `users` SET `profile_picture`='$targetFile' WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userEmail);
        if($stmt->execute()){
            
            if($oldImage && file_exists($oldImage) && $oldImage !== "uploads/profile.jpeg"){
                unlink($oldImage);
            }
            
        $_SESSION['profile_img'] = $targetFile;
        echo "<script>alert('Image Uploaded Successfully!!');
        window.location.href = 'http://localhost/php_e-commerce/profile.php';
        </script>";
        exit();
    }else{
        echo "<script>alert('Error Uploading Image!\nPlease Try Again Later!!');
        window.location.href = './profile.php';
        </script>";
        }
    }
}
?>
</body>
</html>