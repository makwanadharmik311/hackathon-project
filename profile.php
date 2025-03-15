<?php
session_start(); // Start the session
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details including role
$sql = "SELECT name, email, role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $role);
$stmt->fetch();
$stmt->close();

// Set a default profile picture if missing
$profile_picture = "profile.png"; // Replace with your default image
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>

<?php
// Include admin header if role is 'ADMIN', otherwise include normal header
if ($role === 'ADMIN') {
    include('includes/admin/admin_header.php'); 
} else {
    include('includes/header.php'); 
}
?>

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-image">
            <img src="/assets/images/<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture">
            <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="profile_picture" accept="image/*">
                <button type="submit" name="update_picture">Update Picture</button>
            </form>
        </div>
        <h2><?php echo htmlspecialchars($name); ?></h2>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <p>Role: <?php echo htmlspecialchars($role); ?></p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

</body>
</html>
