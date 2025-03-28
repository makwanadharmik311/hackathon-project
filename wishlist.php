<?php 
include('includes/header.php'); 
require 'config.php';

//If user is not Log In or Sign Up
if(!isset($_SESSION['user_email_address'])){
  echo "<script>alert('You have to first Log In/Sign Up!');
  window.location.href = 'auth.php';
  </script>";
  exit();
}

$stmt = $conn->prepare("SELECT `id` FROM `users` WHERE `email` = ?");
$stmt->bind_param("s",$_SESSION['user_email_address']);
$stmt->execute();
$result = $stmt->get_result();
if($row = $result->fetch_assoc()){
    $user_id = $row['id'] ;
}

$sql = "SELECT w.id AS wishlist_id, p.id AS product_id, p.name, p.image_url, p.price FROM wishlist w JOIN crafts p 
ON w.craft_id = p.id WHERE w.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result = $stmt->get_result();

$wishlist_items = [];
while($row = $result->fetch_assoc()){
    $wishlist_items[] = $row;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My WishList</title>
    <link rel="stylesheet" href="assets/css/wishlist.css">
    <script defer src="./assets/js/wishlist.js"></script>
    <script src="https://kit.fontawesome.com/8310276952.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class = "wishlist-container">
        <h2>My Wishlist</h2>
        <div class = "wishlist-items">
            <?php if(count($wishlist_items) > 0) { ?>
                <table><thead><tr><th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($wishlist_items as $item) {  ?>
                    <tr id = "item -<?php echo $item['wishlist_id'];?>">
                        <td><img id = "profile1" src = "<?php echo $item['image_url']; ?>" alt = "<?php echo $item['name']; ?>"> </td>
                        <td><?php echo $item['name']; ?> </td>
                        <td>₹ <?php echo $item['price']; ?></td>
                        <td><form action = "remove_wishlist.php" method = "POST" target = "hiddenFrame">
                            <input type = "hidden" name = "wishlist_id" value = "<?php echo $item['wishlist_id'];?>">
                        <button type = "submit" class = "remove-btn">
                        <i class="fa-solid fa-trash-can"></i>
                        </button></form>
                </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
                <iframe name = "hiddenFrame" style = "display:none;"></iframe> 
                <?php }
                else {
                    echo "<p style = 'color : red;font-size:35px;text-align:center;'> Your Wishlist is Empty!! </p>";
                } ?>
                </div>

    <p style = 'text-align:center;'><a href="http://localhost/php_e-commerce/index.php">Go Back</a></p>

<script src="assets/js/wishlist.js"></script>


</body>
</html>
