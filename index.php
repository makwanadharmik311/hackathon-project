<?php
session_start();
include('config.php'); // Database connection
include('includes/header.php');

// Fetch all products
$query = "SELECT crafts.*, users.name AS artisan_name FROM crafts 
          JOIN users ON crafts.artisan_id = users.id";
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link rel="stylesheet" href="assets/css/products.css">
</head>
<body>

    <section class="product-section">
        <h2>Our Certified Products</h2>
        <div class="product-grid">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="product-card">
                    <a href="product_detail.php?id=<?= htmlspecialchars($row['id']) ?>" class="product-link">
                        <div class="product-img-container">
                            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Craft Image" class="product-img">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><?= htmlspecialchars($row['name']) ?></h3>
                            <p class="product-price">₹<?= number_format($row['price'], 2) ?></p>
                            <div class="product-rating">
                                ★★★★☆ (4.5)
                            </div>
                        </div>
                    </a>
                    <div class="product-actions">
                        <button class="add-to-cart" onclick="addToCart(<?= $row['id']; ?>)">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                        <button class="wishlist" onclick="addToWishlist(<?= $row['id']; ?>)">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

</body>
</html>

<?php include('includes/footer.php'); ?>
