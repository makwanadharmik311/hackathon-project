<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "ADMIN") {
    header("Location: index.php");
    exit;
}
?>

<?php include('includes/admin/admin_header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin <?php echo $_SESSION["user_name"]; ?>!</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
<?php include('includes/admin/admin_footer.php'); ?>
