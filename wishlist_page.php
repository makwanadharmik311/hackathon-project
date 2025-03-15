<?php
session_start();
include('config.php');

$user_id = 1; // Change this based on the logged-in user

$query = "SELECT wishlist.id, crafts.name, crafts.image_url, crafts.price FROM wishlist 
          JOIN crafts ON wishlist.craft_id = crafts.id WHERE wishlist.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result(); // Using a separate variable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Wishlist</title>
    <link rel="stylesheet" href="assets/css/wishlist.css">
</head>
<body>

<?php include('includes/header.php'); ?>

<h2>Your Wishlist</h2>

<div class="wishlist-container">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="wishlist-item">
            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Craft Image" class="product-img">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p>₹<?php echo number_format($row['price'], 2); ?></p>
            <!-- ❌ Removed the "Quantity" line -->
            <button onclick="removeFromWishlist(<?php echo $row['id']; ?>)">Remove</button>
        </div>
    <?php endwhile; ?>
</div>

<script>
function removeFromWishlist(wishlistId) {
    fetch('wishlist.php?action=delete&id=' + wishlistId, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}
</script>

</body>
</html>
