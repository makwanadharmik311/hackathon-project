<?php
session_start();
require_once "config.php"; // Include database connection

// Ensure only admins can update certification status
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ADMIN') {
    echo json_encode(["message" => "Unauthorized action"]);
    exit();
}

// Check if product ID and certification status are provided
if (isset($_POST['product_id']) && isset($_POST['certification_status'])) {
    $productId = intval($_POST['product_id']);
    $certificationStatus = $_POST['certification_status'];

    $stmt = $conn->prepare("UPDATE crafts SET certification_status = ? WHERE id = ?");
    $stmt->bind_param("si", $certificationStatus, $productId);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Certification status updated successfully"]);
    } else {
        echo json_encode(["message" => "Error updating certification status"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
