<?php
session_start();
require_once "config.php"; // Database connection

// Ensure only admins can perform deletions
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ADMIN') {
    echo json_encode(["message" => "Unauthorized action"]);
    exit();
}

// Check if ID is provided
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Prevent admin from deleting themselves
    if ($userId == $_SESSION['user_id']) {
        echo json_encode(["message" => "You cannot delete yourself!"]);
        exit();
    }

    // Delete user from the database
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User deleted successfully"]);
    } else {
        echo json_encode(["message" => "Failed to delete user"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
