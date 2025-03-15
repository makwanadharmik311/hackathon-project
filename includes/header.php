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
    <title>PHP E-Commerce</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="/assets/images/logo.png" alt="Website Logo">
        </div>

        <nav>
            <ul>
                <li><a href="/index.php" data-en="Home" data-gu="હોમ">Home</a></li>
                <li><a href="#" data-en="About" data-gu="અમારા વિશે">About</a></li>
                <li><a href="#" data-en="Services" data-gu="સેવાઓ">Services</a></li>
                <li><a href="/contact.php" data-en="Contact" data-gu="સંપર્ક">Contact</a></li>
            </ul>
        </nav>

        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search...">
            <button id="search-btn">🔍</button>
        </div>

        <nav>
            <ul>
                <li>
                    <img src="/assets/images/wishlist.png" alt="WishList Logo" class="icon">
                    <a href="/wishlist_page.php" data-en="WishList" data-gu="વિશલિસ્ટ">WishList</a>
                </li>

                <li>
                    <img src="/assets/images/cart.png" alt="Cart Logo" class="icon">
                    <a href="/cart_page.php" data-en="Cart" data-gu="કાર્ટ">Cart</a>
                </li>

                <li>
                    <img src="/assets/images/check-out.png" alt="Order  Logo" class="icon">
                    <a href="/orders.php" data-en="My Orders" data-gu="કાર્ટ">My Orders</a>
                </li>
            </ul>
        </nav>

        <div class="auth-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/profile.php">
                    <img src="/assets/images/profile.png" alt="Profile" class="profile-icon">
                </a>
                <a href="/logout.php" id="logout-btn">Logout</a>
            <?php else: ?>
                <a href="/auth.php" id="login-btn">Login</a>
                <a href="/auth.php" id="signup-btn">Sign Up</a>
            <?php endif; ?>
        </div>
    </header>
</body>
</html>
