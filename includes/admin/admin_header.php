<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="/assets/images/logo.png" alt="Website Logo">
        </div>

        <nav>
            <ul>
                <li><a href="/admin_dashboard.php" data-en="Dashboard" data-gu="ડેશબોર્ડ">Dashboard</a></li>
                <li><a href="/manage_users.php" data-en="Manage Users" data-gu="વપરાશકર્તાઓ">Manage Users</a></li>
                <li><a href="/manage_products.php" data-en="Manage Products" data-gu="પ્રોડક્ટ્સ">Manage Products</a></li>
                <li><a href="/manage_orders.php" data-en="Manage Orders" data-gu="ઓર્ડર્સ">Manage Orders</a></li>
                <li><a href="/reports.php" data-en="Reports" data-gu="અહેવાલ">Reports</a></li>
            </ul>
        </nav>

        <div class="auth-buttons">
            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'ADMIN'): ?>
                <a href="/profile.php">
                    <img src="/assets/images/profile.png" alt="Admin Profile" class="profile-icon">
                </a>
                <a href="/logout.php" id="logout-btn">Logout</a>
            <?php else: ?>
                <a href="/auth.php" id="login-btn">Login</a>
            <?php endif; ?>
        </div>
    </header>
</body>
</html>
