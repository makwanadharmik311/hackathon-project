<?php
include 'config.php';

if (isset($_POST['SignUp'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    
    // Set default role if not provided
    $role = isset($_POST['role']) ? $_POST['role'] : 'COLLECTOR'; 

    // Prepare SQL Statement
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $email, $password, $role);

    // Execute statement and check for errors
    if ($stmt->execute()) {
        // Redirect based on role after successful registration
        if ($role == "ADMIN") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        // Log and display error if execution fails
        error_log("Insert Error: " . $stmt->error);
        die("Error inserting data: " . $stmt->error);
    }

    // Close statement & connection
    $stmt->close();
    $conn->close();
}
?>


<?php
include 'config.php';
session_start();

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
            $_SESSION["role"] = $user["role"];  // Store user role in session

            // Redirect based on user role
            if ($user["role"] === "ADMIN") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/auth.css">
    <title>Modern Login Page</title>
</head>

<body>

    <!-- Language Toggle Button -->
    <button id="language-toggle" onclick="toggleLanguage()">English</button>

    <div class="container" id="container">
        <!-- Sign-Up Form -->
        <div class="form-container sign-up">
            <form id="signup-form" method="post">
                <h1 id="signup-header">Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
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
        </div>

        <!-- Sign-In Form -->
        <div class="form-container sign-in">
            <form id="signin-form" method="POST">
                <h1 id="signin-header">User Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span id="signin-or">or use your email and password</span>
                <input type="email" id="signin-email" name="email" placeholder="Email">
                
                <!-- Password Field with Eye Icon -->
                <div class="password-container">
                    <input type="password" id="signin-password" name="password" placeholder="Password">
                    <i class="fa-solid fa-eye" onclick="togglePassword('signin-password', this)"></i>
                </div>

                <a href="#" id="forgot-password">Forgot Your Password?</a>
                <button type="submit" name="SignIn" id="signin-button" value="SignIn">Sign In</button>
            </form>
        </div>

        <!-- Toggle Panel for Switching Between Forms -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1 id="back-welcome">Welcome Back!</h1>
                    <p id="back-details">Enter your personal details to use all site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1 id="hello-friend">Hello, Friend!</h1>
                    <p id="friend-details">Register with your personal details to use all site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>

    </div>

    <!-- SLIDER BUTTON TO SWITCH LOGIN PAGE -->
    <div class="slider-container">
        <span>User Login</span>
        <label class="slider">
            <input type="checkbox" id="login-slider" onclick="toggleLoginPage()">
            <span class="slider-round"></span>
        </label>
        <span>Seller Login</span>
    </div>

    <script src="/assets/js/auth.js"></script>
</body>

</html>





