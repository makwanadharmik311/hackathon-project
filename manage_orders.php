<?php
session_start();
include 'config.php';  // Corrected path

// Check if connection is established
if (!isset($conn)) {
    die("Database connection failed.");
}

// Fetch all orders with user details
$query = "SELECT orders.*, users.name AS customer_name 
          FROM orders 
          JOIN users ON orders.user_id = users.id 
          ORDER BY orders.created_at DESC";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="assets/css/admin/manage_orders.css">
</head>
<body>
<?php 
if (file_exists('includes/admin/admin_header.php')) {
    include 'includes/admin/admin_header.php'; 
} else {
    echo "<p style='color:red;'>Header file missing!</p>";
}
?>
<div class="container">
    <h2>Manage Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['customer_name']) ?></td>
                <td>$<?= number_format($row['total_price'], 2) ?></td>
                <td>
                    <select onchange="updateOrderStatus(<?= $row['id'] ?>, this.value)">
                        <?php 
                        $statuses = ['PENDING', 'SHIPPED', 'DELIVERED', 'CANCELLED', 'RETURNED'];
                        foreach ($statuses as $status) {
                            echo "<option value='$status' " . ($row['status'] === $status ? "selected" : "") . ">$status</option>";
                        }
                        ?>
                    </select>
                </td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
                <td>
                    <button class="delete-btn" onclick="deleteOrder(<?= $row['id'] ?>)">Delete</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

    <script>
        function deleteOrder(orderId) {
            if (!confirm("Are you sure you want to delete this order?")) {
                return;
            }

            fetch('delete_order.php', {
                method: 'POST',
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `order_id=${orderId}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.message === "Order deleted successfully") {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function updateOrderStatus(orderId, newStatus) {
            if (!confirm("Are you sure you want to update the order status?")) {
                return;
            }

            fetch('update_order_status.php', {
                method: 'POST',
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `order_id=${orderId}&status=${newStatus}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.message === "Order status updated successfully") {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</body>
</html>
