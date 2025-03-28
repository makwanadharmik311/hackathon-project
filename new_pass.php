<?php 
require_once 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_email_address'])) {
    echo "<script>alert('You have to first Log In/Sign Up!');
    window.location.href = 'auth.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
        }
        .card {
            margin: 100px auto;
            max-width: 400px;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
        }
        .form-control, label, small {
            color: white;
        }
        #message {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="card">
    <h3 class="text-center">Change Password</h3>
    <form id="passwordForm" action="change_pass.php" method="POST" onsubmit="return validateForm()">
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="npass" id="newPassword" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" id="confirmPassword" name="cpass" class="form-control" required>
            <small>Password & Confirm Password must match.</small>
        </div>
        <span id="message"></span><br>
        <input type="submit" name="submitpass" value="Change" class="btn btn-danger btn-block">                          
    </form>
</div>

<script>
function checkPasswordMatch() {
    let newPassword = document.getElementById("newPassword").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let message = document.getElementById("message");

    if (newPassword === confirmPassword && newPassword !== "") {
        message.style.color = "green";
        message.innerHTML = "✅ Passwords match!";
        return true;
    } else {
        message.style.color = "red";
        message.innerHTML = "❌ Passwords do not match!";
        return false;
    }
}

function validatePassword(password) {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/;
    return regex.test(password);
}

function validateForm() {
    if (!checkPasswordMatch()) {
        alert("Passwords do not match!");
        return false;
    }
    let password = document.getElementById("newPassword").value;
    if (!validatePassword(password)) {
        alert("Password must contain at least one uppercase, one lowercase, one number, one special character and be minimum 6 characters long.");
        return false;
    }
    return true;
}
</script>

</body>
</html>