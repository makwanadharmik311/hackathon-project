<?php
session_start();
include('config.php');

$user_id = 1; // Change this based on the logged-in user

$query = "SELECT cart.id, crafts.name, crafts.image_url, crafts.price, cart.quantity FROM cart 
          JOIN crafts ON cart.craft_id = crafts.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="assets/css/cart.css">
</head>
<body>

<?php
    include('includes/header.php');
?>

<h2>Your Cart</h2>

<div class="cart-container">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="cart-item">
            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Craft Image" class="product-img">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p>₹<?php echo number_format($row['price'], 2); ?></p>
            <p>Quantity: <?php echo $row['quantity']; ?></p>
            <button onclick="removeFromCart(<?php echo $row['id']; ?>)">Remove</button>
        </div>
    <?php endwhile; ?>
</div>

<script>
function removeFromCart(cartId) {
    fetch('cart.php?action=delete&id=' + cartId)
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
