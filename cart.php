<?php
session_start();
include('config.php');

$user_id = 1; // Change this based on the logged-in user

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'add' && isset($_GET['id'])) {
        $craft_id = intval($_GET['id']);
        $stmt = $conn->prepare("INSERT INTO cart (user_id, craft_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
        $stmt->bind_param("ii", $user_id, $craft_id);
        $stmt->execute();
        echo json_encode(["message" => "Added to Cart"]);
    } 
    
    elseif ($action == 'delete' && isset($_GET['id'])) {
        $cart_id = intval($_GET['id']);
        $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $cart_id, $user_id);
        $stmt->execute();
        echo json_encode(["message" => "Removed from Cart"]);
    }
}
?>
