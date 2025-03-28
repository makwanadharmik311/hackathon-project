<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('config.php'); // Ensure database connection

header('Content-Type: application/json'); // Set JSON header

if (!isset($_GET['q'])) {
    echo json_encode(["error" => "No search query provided"]);
    exit;
}

$searchQuery = trim($_GET['q']);
if (empty($searchQuery)) {
    echo json_encode(["error" => "Empty search query"]);
    exit;
}

$searchQuery = mysqli_real_escape_string($conn, $searchQuery);

// Query to search crafts by name and description
$sql = "SELECT id, name, description, price, image_url, model_url, stock, certification_status 
        FROM crafts 
        WHERE (name LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%') 
        AND certification_status = 'CERTIFIED'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(["error" => "Database error: " . mysqli_error($conn)]);
    exit;
}

$crafts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $crafts[] = $row;
}

echo json_encode($crafts);
mysqli_close($conn);

?>
