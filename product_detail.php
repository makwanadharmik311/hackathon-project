<?php
session_start();
include('config.php');
include('includes/header.php');

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first!'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM crafts WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
} else {
    echo "Product not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="assets/css/product.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-key.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="product-container">
    <div class="product-gallery">
        <img id="mainImage" src="<?= htmlspecialchars($product['image_url']) ?>" alt="Main Product Image">
        <div class="thumbnails">
            <img src="<?= htmlspecialchars($product['image_url']) ?>" onclick="changeImage(this)">
            <img src="assets/images/sample1.jpg" onclick="changeImage(this)">
            <img src="assets/images/sample2.jpg" onclick="changeImage(this)">
        </div>
    </div>

    <div class="product-details">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>
        <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>

        <div class="buttons">
            <button class="add-to-cart" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
            <a href="buy_now.php?id=<?php echo $product['id']; ?>" class="buy-now">Buy Now</a>
            <button class="wishlist" onclick="addToWishlist(<?php echo $product['id']; ?>)">
                <i class="fas fa-heart"></i> Wishlist
            </button>
        </div>
    </div>
</div>

<script src="assets/js/product.js"></script>
<script>
    function changeImage(element) {
        document.getElementById('mainImage').src = element.src;
    }

    function addToCart(productId) {
        fetch('cart.php?action=add&id=' + productId)
            .then(response => response.json())
            .then(data => alert(data.message))
            .catch(error => console.error('Error:', error));
    }

    function addToWishlist(productId) {
        fetch('wishlist.php?action=add&id=' + productId)
            .then(response => response.json())
            .then(data => alert(data.message))
            .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>

<?php include('includes/footer.php'); ?>
