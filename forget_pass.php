<?php
if(session_status()== PHP_SESSION_NONE){
    include_once 'includes/sessionStart.php';
}

if(isset($_GET['forget']) && $_GET['forget'] == 'true') 
$_SESSION['forget'] = true;
else
header('Location: auth.php');
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
</head>
<body>
    <form method = "POST">
        <input type="email" id="signin-email" name="email" placeholder="Email" required>
        <button type="submit" name="submit" id="signin-button" value="SignIn">Submit</button>
    </form>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    $email = trim($_POST["email"]);
    if (empty($email)) {
        echo "<script>alert('You have to enter your E-Mail I'D!');</script>";
        exit;
    }

    // Fetch user data
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();  
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION['user_email_address'] = $user['email'];
        header('Location:new_pass.php');
    }

    else{
        echo "<script>alert('You have to First Sign Up!');</script>";
        echo "<script>window.location.href = 'auth.php'</script>";
    }

}
?>