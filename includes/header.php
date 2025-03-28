<?php
include_once 'includes/sessionStart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/index.css">
    <!-- <link rel = "stylesheet" href = "assets/css/index.css"> -->

</head>
<body>
            <?php
                if(isset($_SESSION['user_name'])) $login = true; else $login = false;
            ?>

<div>
        <a href="#" ><img src="assets/images/fin_logo.jpeg" alt="Website  Logo" title = "Logo" class="logo"></a> <!-- Logo for the website -->

        <div class="language-container">
            <label for="language-select">🌍 Select Language:</label>
            <div id="google_translate_element"></div>
        </div>
    
    <div>
        <ul id="navbar">
            <li><a class="active" href="http://localhost/php_e-commerce/index.php">Home</a></li>
            <li><a  class="active" href="about.html">About</a></li>
            <li><a  class="active" href="sevices.html">Sevices</a></li>
            <li><a   class="active" href="contact.html">Contact</a></li>
            <div class="search-container">
            <form id="searchForm">
                <input type="text" id="searchQuery" placeholder="Search for products..." required>
                <button type="submit">🔍 Search</button>
                <button type="submit" id="clearSearch">❌ Clear</button>    
            </form>
            <!-- ✅ Ensure search results are in a separate div below the form -->
               
        </div>
<li><a href="cart.html"><img src="./assets/images/shopping-cart.png" alt="Shopping Cart Icon" title = "Cart" ></a></li>
<li> <a href="http://localhost/php_e-commerce/wishlist.php"><img src="./assets/images/wishlist.png" alt="WishList" class="icon" title = "Wishlist"></a></li>
<li><a href="./profile.php"><img src="./default.png" alt="User Profile Icon" title = "Profile"></a></li>

            <div class="auth-buttons">
                <a href="http://localhost/php_e-commerce/auth.php"id="login-btn" <?php if($login) echo "style = 'display : none;'";?>>Login\Sign Up</a>
                <a href="http://localhost/php_e-commerce/logout.php"id="login-btn" <?php if(!$login) echo "style = 'display : none;'";?>>Log Out</a>
            </div>
        </ul>
       
    </div>
    <div id="sidebar" class="sidebar">
        <button class="close-btn" onclick="toggleSidebar()">&times;</button>
        <a href="http://localhost/php_e-commerce/index.php">Home</a>
        <a href="about.html">About</a>
        <a href="sevices.html">Services</a>
        <a href="contact.html">Contact</a>
        <a href="cart.html">Cart</a>
        <a href="Profile.html">Profile</a>
        <a href="http://localhost/php_e-commerce/auth.php" <?php if($login) echo "style = 'display : none;'";?>>Login</a>
        <a href="http://localhost/php_e-commerce/auth.php" <?php if($login) echo "style = 'display : none;'";?>>Sign Up</a>
        <a href="http://localhost/php_e-commerce/logout.php" <?php if(!$login) echo "style = 'display : none;'";?>>Log Out</a>
    </div>
    
    <button class="open-btn" onclick="toggleSidebar()">&#9776; Menu</button>
</div>

</body>
</html>