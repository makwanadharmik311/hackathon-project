<?php
session_start();
include('config.php');

$user_id = $_SESSION['user_id'] ?? 1; // Example: Replace with actual session user ID

// Fetch user details
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result()->fetch_assoc();

// Fetch product details if `id` is passed via GET
$product_id = $_GET['id'] ?? null;
if ($product_id) {
    $stmt = $conn->prepare("SELECT id, name, price, image_url FROM crafts WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $total_price = $_POST['total_price'];
    $product_id = $_POST['product_id'];

    // Insert order
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, 'PENDING')");
    $stmt->bind_param("id", $user_id, $total_price);
    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Insert ordered product
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, craft_id, quantity, price) VALUES (?, ?, 1, ?)");
        $stmt->bind_param("iid", $order_id, $product_id, $total_price);
        $stmt->execute();

        echo "<script>alert('Order placed successfully!'); window.location.href='orders.php';</script>";
    } else {
        echo "<script>alert('Order failed!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Buy Now</title>
    <link rel="stylesheet" href="assets/css/buy_now.css">
</head>
<body>

<h2>Buy Now</h2>

<form method="POST">
    <h3>User Details</h3>
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($user_result['name'] ?? ''); ?>" readonly>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user_result['email'] ?? ''); ?>" readonly>

    <h3>Product Details</h3>
    <?php if ($product): ?>
        <img src="assets/images/<?php echo htmlspecialchars($product['image_url']); ?>" alt="Product" width="100">
        <p>Name: <?php echo htmlspecialchars($product['name']); ?></p>
        <p>Price: ₹<?php echo number_format($product['price'], 2); ?></p>
        <input type="hidden" name="total_price" value="<?php echo $product['price']; ?>">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <?php endif; ?>

    <h3>Shipping Details</h3>
    <label>Address:</label>
    <textarea name="address" required></textarea>

    <h3>Payment Method</h3>
    <select name="payment_method" required>
        <option value="COD">Cash on Delivery</option>
        <option value="Card">Credit/Debit Card</option>
    </select>

    <button type="submit">Confirm Purchase</button>
</form>

</body>
</html>
