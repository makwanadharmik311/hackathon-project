<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_email_address']) || !isset($_POST['wishlist_id'])) {
    die("Unauthorized access!");
}

$wishlist_id = $_POST['wishlist_id'];
$stmt = $conn->prepare("SELECT `id` FROM `users` WHERE `email` = ?");
$stmt->bind_param("s",$_SESSION['user_email_address']);
$stmt->execute();
$result = $stmt->get_result();
if($row = $result->fetch_assoc()){
    $user_id = $row['id'] ;
}

// Delete item from Wishlist table
$sql = "DELETE FROM Wishlist WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $wishlist_id, $user_id);

if ($stmt->execute()) {
    echo "<script>parent.location.reload();</script>"; // Refresh parent page after deletion
} else {
    echo "<script>alert('Error removing item: " . $stmt->error . "');</script>";
}

$stmt->close();
?>