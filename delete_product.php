<?php
session_start();
require_once "config.php"; // Include database connection

// Ensure only admins can perform deletions
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ADMIN') {
    echo json_encode(["message" => "Unauthorized action"]);
    exit();
}

// Check if product ID is provided
if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);

    $stmt = $conn->prepare("DELETE FROM crafts WHERE id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Product deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error deleting product"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
