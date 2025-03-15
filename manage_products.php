<?php
session_start();
include 'config.php'; // Ensure this is the correct path

if (!isset($conn)) {
    die("Database connection not established.");
}

// Fetch all products
$query = "SELECT crafts.*, users.name AS artisan_name FROM crafts 
          JOIN users ON crafts.artisan_id = users.id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="/assets/css/admin/manage_products.css">
</head>
<body>
    <?php include 'includes/admin/admin_header.php'; ?> <!-- Ensure correct path -->

    <div class="container">
        <h2>Manage Products</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Artisan</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Certification</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Craft Image" class="product-img"></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['artisan_name']) ?></td>
                    <td>$<?= htmlspecialchars($row['price']) ?></td>
                    <td><?= htmlspecialchars($row['stock']) ?></td>
                    <td>
                        <select onchange="updateCertification(<?= $row['id'] ?>, this.value)">
                            <option value="PENDING" <?= $row['certification_status'] === 'PENDING' ? 'selected' : '' ?>>Pending</option>
                            <option value="CERTIFIED" <?= $row['certification_status'] === 'CERTIFIED' ? 'selected' : '' ?>>Certified</option>
                            <option value="REJECTED" <?= $row['certification_status'] === 'REJECTED' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                    </td>
                    <td>
                        <button onclick="editProduct(<?= $row['id'] ?>)">Edit</button>
                        <button onclick="deleteProduct(<?= $row['id'] ?>)">Delete</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function deleteProduct(productId) {
            if (!confirm("Are you sure you want to delete this product?")) {
                return;
            }

            fetch('delete_product.php', {
                method: 'POST',
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.message === "Product deleted successfully") {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function updateCertification(productId, newStatus) {
            if (!confirm("Are you sure you want to update this certification status?")) {
                return;
            }

            fetch('update_certification.php', {
                method: 'POST',
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `product_id=${productId}&certification_status=${newStatus}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.message === "Certification status updated successfully") {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</body>
</html>
