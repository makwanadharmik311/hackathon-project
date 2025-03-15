<?php
session_start();
require_once "config.php"; // Include database connection

// Ensure only admins can update order status
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ADMIN') {
    echo json_encode(["message" => "Unauthorized action"]);
    exit();
}

// Check if order ID and status are provided
if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $orderId = intval($_POST['order_id']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $orderId);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Order status updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update order status"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
