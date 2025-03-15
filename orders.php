<?php
session_start();
include('config.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>Please log in to view your orders.</p>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch orders with their items
$query = "
    SELECT o.id AS order_id, o.total_price, o.status, o.created_at, 
           oi.craft_id, oi.quantity, oi.price, c.name AS craft_name 
    FROM orders o
    LEFT JOIN order_items oi ON o.id = oi.order_id
    LEFT JOIN crafts c ON oi.craft_id = c.id
    WHERE o.user_id = ?
    ORDER BY o.created_at DESC, oi.id ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Store orders and items in an associative array
$orders = [];
while ($row = $result->fetch_assoc()) {
    $order_id = $row['order_id'];
    
    // Group items under their respective orders
    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'total_price' => $row['total_price'],
            'status' => $row['status'],
            'created_at' => $row['created_at'],
            'items' => []
        ];
    }

    // Add order items
    if ($row['craft_id']) {
        $orders[$order_id]['items'][] = [
            'craft_name' => $row['craft_name'],
            'quantity' => $row['quantity'],
            'price' => $row['price']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="assets/css/orders.css">
    <style>
        h2 {
            text-align: center;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .order-container {
            display: flex;
            justify-content: center;
        }
        .items-table {
            width: 100%;
            margin-top: 5px;
        }
        .items-table th, .items-table td {
            border: 1px solid #ccc;
            padding: 5px;
        }
        .expand-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<h2>My Orders</h2>

<div class="order-container">
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Price (₹)</th>
                <th>Status</th>
                <th>Placed On</th>
                <th>Items</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order_id => $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order_id); ?></td>
                    <td><?php echo "₹" . number_format($order['total_price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                    <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                    <td>
                        <button class="expand-btn" onclick="toggleItems('<?php echo $order_id; ?>')">View Items</button>
                    </td>
                </tr>
                <tr id="items-<?php echo $order_id; ?>" class="hidden">
                    <td colspan="5">
                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>Craft Name</th>
                                    <th>Quantity</th>
                                    <th>Price (₹)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order['items'] as $item): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['craft_name']); ?></td>
                                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                        <td><?php echo "₹" . number_format($item['price'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function toggleItems(orderId) {
        var itemsRow = document.getElementById('items-' + orderId);
        itemsRow.classList.toggle('hidden');
    }
</script>

</body>
</html>
