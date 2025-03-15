<?php
session_start();
require_once "config.php"; // Include database connection

// Ensure only admins can delete orders
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ADMIN') {
    echo json_encode(["message" => "Unauthorized action"]);
    exit();
}

// Check if order ID is provided
if (isset($_POST['order_id'])) {
    $orderId = intval($_POST['order_id']);

    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->bind_param("i", $orderId);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Order deleted successfully"]);
    } else {
        echo json_encode(["message" => "Failed to delete order"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
