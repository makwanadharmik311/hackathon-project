<?php 
//include_once 'includes/sessionStart.php';
include('includes/header.php'); 
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tribal Arts & Crafts</title>
    <script src="./assets/js/index.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>

<section id="main">
  
    <div class="image">
        <!-- <img src = "assets\images\indbg.jpg" alt = "BG"> -->
        <h1 class="rotate">WELCOME TO OUR SHOP</h1> <!-- Main heading for the shop -->

        <p id="pra">Every piece tells a story, crafted with love and devotion. By purchasing tribal art, you help sustain age-old traditions and empower talented artisans. Browse our exclusive collection today!</p>
        
    </div>
</section>

<div class="bg-img">
    <div class="feature-box">
        <img src="assets/images/vector-fast-delivery-icon-illustration_723554-1032.avif" alt="Fast Delivery Icon - Fast Shipping Service">

        <h3>Fast Shipping</h3>
        <p>Get your products delivered quickly and safely.</p>
    </div>
    <div class="feature-box">
        <img src="assets/images/Support24-7.jpg" alt="Customer Support Icon - 24/7 Support">

        <h3>24/7 Support</h3>
        <p>Our team is available anytime for your queries.</p>
    </div>
    <div class="feature-box">
        <img src="assets/images/safe.png" alt="Secure Payment Icon - Secure Payment Options">

        <h3>Secure Payments</h3>
        <p>100% safe and secure payment options.</p>
    </div>
</div>

<main>
    <div id="searchResults"></div>
</main>


<div class="h1pro">
    <h1> Our Products</h1>
</div>
<div class="product-grid">
    
<?php
      $sql = "SELECT * FROM crafts";
      $stmt = $conn->prepare($sql);
      //$stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();  
     ?>
<?php 
while($product = $result->fetch_assoc()) { ?>

    <div class="product-card">
        <img src="<?php echo $product['image_url']?>" alt="<?php echo $product['name'];?>">
        <form method = "POST" target = "hidden_iframe">
            <input type = "hidden" name = "product_id" value = "<?php echo $product['id']?>">
            <button type = "submit" name = "add_to_wishlist" class = "wishlist-btn"> Add To Wishlist </button>
            </form>
            <iframe name = "hidden_iframe" style = "display:none;"></iframe>
        <form method = "POST" target = "hidden_iframe">
            <input type = "hidden" name = "product_id" value = "<?php echo $product['id']?>">
            <button type = "submit" name = "add_to_cart" class = "wishlist-btn"> Add To Cart </button>
            </form>
            <iframe name = "hidden_iframe" style = "display:none;"></iframe>
            
        <div class="product-name"><?php echo $product['name'];?></div> <!-- Product name -->
        
        <div class="product-price">₹<?php echo $product['price'];?></div>
        <div class="rating">&#9733 &#9733 &#9733 </div>
        <a href="product-details(1).html" class="add-to-cart">About Product</a>
    </div>
    <?php } ?>
</div>

<!-- WishList -->
<?php
    if(isset($_POST['add_to_wishlist'])){
        echo "<div style = 'color : red;'> $_POST </div>";
        if(!isset($_SESSION['user_email_address'])){
            echo "<script>alert('You have to first Log In/Sign Up!');
            window.location.href = 'auth.php';
            </script>";
            exit();
        }
        
        $wishlist_product_id = $_POST['product_id'];
        echo $wishlist_product_id;
        $user_id = $_SESSION["user_id"];
        echo "<script>alert('Product with added Successfully!');</script>";
        $sql = "SELECT * FROM wishlist WHERE user_id = ? AND craft_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $wishlist_product_id);
        if(!$stmt->execute()){die("Execution failed : " . $stmt->error);}
        $stmt->store_result();
        if($stmt->num_rows == 0){
            $sql = "INSERT INTO wishlist(user_id, craft_id) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $user_id, $wishlist_product_id);
            if($stmt->execute()) echo "<script>alert('Product1 with added Successfully!');</script>";
        }
        
    }   
?>
<footer>
    <?php include 'includes/footer.php'; ?> 
</footer> 

<!-- Floating Chatbot Button -->
<button id="chatbot-button" class="floating-button" title="Need Help? Ask Me!"></button>

    
</body>
</html>
