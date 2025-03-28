<?php
require_once 'con1.php';
//unset($_SESSION['access-token']);
//unset($_SESSION['user_email_address']);

$authUrl = $google_client->createAuthUrl();
?>

<?php
require_once 'config.php';



if (isset($_POST['SignUp'])) {
    $name = trim($_POST['name']);
    $_SESSION['user_name'] = $name;
    $email = trim($_POST['email']);
    $_SESSION['user_email_address'] = $email;
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    
    // Set default role if not provided
    $_SESSION["role"] = isset($_POST['role']) ? $_POST['role'] : 'COLLECTOR'; 
    $role = $_SESSION["role"];
    // Prepare SQL Statement
    $stmt = $conn->prepare('INSERT INTO `users` (name, email, password, role) VALUES (?, ?, ?, ?)');

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $email, $password, $role);

    // Execute statement and check for errors

    // if (!$stmt->execute()) {
    //     // // Redirect based on role after successful registration
    //     // if ($role == "ADMIN") {
    //     //     header("Location: admin_dashboard.php");
    //     // } else {
    //     //     header("Location: index.php");
    //     // }
    //     // exit;
    //     echo $stmt->errno;
    //     if($stmt->errno == 1062){
    //         echo "<script>alert('You have already Sign Up, Now You have to Log In');
    //         window.location.href = 'auth.php';</script>";
    //         $stmt->close();
    //         $conn->close();   
    //         exit();
    //     }
    //     else{
    //         echo "Error : " . $stmt->error;
    //         $stmt->close();
    //         $conn->close();   
    //     }
    // }
    //  else {
    //     // Log and display error if execution 
    //     $_SESSION['otp'] = rand(100000, 999999);
    //     header("Location: verify_otp.php");
    //     $stmt->close();
    //     $conn->close();
    //     exit();
    //     // error_log("Insert Error: " . $stmt->error);
    //     // die("Error inserting data: " . $stmt->error);
    // }

    // // Close statement & connection

    try{
        $stmt->execute();
        $query = "SELECT id FROM  `users` where email = '$email'";
        $res = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($res);
        $_SESSION["user_id"] = $row['id'];

        $_SESSION['otp'] = rand(100000, 999999);
        header("Location: verify_otp.php");
        $stmt->close();
        $conn->close();
        exit();

    }catch(mysqli_sql_exception $e){
        if($e->getCode() == 1062){
            echo "<script>alert('You have already Signed Up, Now You have to Log In');
              window.location.href = 'auth.php';</script>";
        } else{
            echo "Error : " . $e->getMessage();
        }
        $stmt->close();
        $conn->close();
        exit();
    }
}
?>


<?php
require_once 'config.php';

if (isset($_POST['SignIn'])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Both fields are required!');</script>";
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
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION['user_email_address'] = $user['email'];
            $_SESSION["role"] = $user["role"];  // Store user role in session
            $_SESSION['otp'] = rand(100000, 999999);
            echo "<script>window.location.href = 'verify_otp.php';
            </script>";
            exit();
            // // Redirect based on user role
            // if ($user["role"] === "ADMIN") {
            //     header("Location: admin_dashboard.php");
            // } else {
            //     header("Location: index.php");
            // }
            // exit;
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/auth.css">
    <title>Modern Login Page</title>
</head>

<body>

    <!-- Language Toggle Button -->
    <button id="language-toggle" onclick="toggleLanguage()">English</button>

    <div class="container" id="container">
        <!-- Sign-Up Form -->
        <div class="form-container sign-up">
            <form id="signup-form" method="post" onsubmit = "return checkPassword();">
                <h1 id="signup-header">Create Account</h1>
                <!--<div class="social-icons">
                   <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div> -->
                <a href="<?php echo htmlspecialchars($authUrl); ?>" class="google-signup-btn">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo">
                Sign Up with Google
                </a>
                <span id="signup-or">or use your email for registration</span>

                <input type="text" id="signup-name" name="name" placeholder="Name" required>

                <input type="email" id="signup-email" name="email" placeholder="Email" required>
                
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

                <button type="submit" name="SignUp" id="signup-button" value="SignUp">Sign Up</button>
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

        <!-- Sign-In Form -->
        <div class="form-container sign-in">
            <form id="signin-form" method="POST">
                <h1 id="signin-header">User Sign In</h1>
                <!-- <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div> -->
                <a id = "logGoogle" href="<?php echo htmlspecialchars($authUrl); ?>" class="google-signup-btn">
               <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo">
                Login with Google
                </a>
                <span id="signin-or">or use your email and password</span>
                <input type="email" id="signin-email" name="email" placeholder="Email" required>
                
                <!-- Password Field with Eye Icon -->
                <div class="password-container">
                    <input type="password" id="signin-password" name="password" placeholder="Password" required>
                    <i class="fa-solid fa-eye" onclick="togglePassword('signin-password', this)"></i>
                </div>

                <a href="forget_pass.php?forget=true" id="forgot-password">Forgot Your Password?</a>
                <button type="submit" name="SignIn" id="signin-button" value="SignIn">Sign In</button>
            </form>
        </div>

        <!-- Toggle Panel for Switching Between Forms -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1 id="hello-friend">Hello, Friend!</h1>
                    <p id="friend-details">Enter your personal details to use all site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1 id="back-welcome">Welcome Back!</h1>
                    <p id="back-details">Register with your personal details to use all site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>

    </div>

    <!-- SLIDER BUTTON TO SWITCH LOGIN PAGE -->
    <!-- <div class="slider-container">
        <span>Customer Login</span>
        <label class="slider">
            <input type="checkbox" id="login-slider" onclick="toggleLoginPage()">
            <span class="slider-round"></span>
        </label>
        <span>Artist Login</span>
    </div> -->

    <script src="assets/js/auth.js"></script>
    <script src="assets/js/validation.js"></script>

</body>

</html>