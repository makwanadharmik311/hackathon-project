<?php
session_start();
require_once "config.php"; // Include database connection

// Ensure only admins can update roles
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ADMIN') {
    echo json_encode(["message" => "Unauthorized action"]);
    exit();
}

// Check if ID and role are provided
if (isset($_POST['id']) && isset($_POST['role'])) {
    $userId = intval($_POST['id']);
    $newRole = $_POST['role'];

    // Prevent admin from updating their own role
    if ($userId == $_SESSION['user_id']) {
        echo json_encode(["message" => "You cannot change your own role!"]);
        exit();
    }

    // Update the role in the database
    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $newRole, $userId);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User role updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update role"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
