<?php
session_start();
require_once "config.php"; // Include database connection

// Ensure only admins can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: index.php");
    exit();
}

// Fetch users from the database
$query = "SELECT id, name, email, role, created_at FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="/assets/css/admin/manage_users.css">
</head>
<body>
    <?php include 'includes/admin/admin_header.php'; ?> <!-- Ensure correct path -->

    <div class="container">
        <h2>Manage Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>
                        <select onchange="updateRole(<?= $row['id'] ?>, this.value)">
                            <option value="ARTISAN" <?= $row['role'] === 'ARTISAN' ? 'selected' : '' ?>>Artisan</option>
                            <option value="COLLECTOR" <?= $row['role'] === 'COLLECTOR' ? 'selected' : '' ?>>Collector</option>
                            <option value="INSTITUTION" <?= $row['role'] === 'INSTITUTION' ? 'selected' : '' ?>>Institution</option>
                            <option value="ADMIN" <?= $row['role'] === 'ADMIN' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td>
                        <button onclick="removeUserById(<?php echo $row['id']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function removeUserById(userId) {
            if (!confirm("Are you sure you want to delete this user?")) {
                return;
            }

            fetch('delete_user.php?id=' + userId, { method: 'GET' }) // Ensure GET method
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.message === "User deleted successfully") {
                        location.reload(); // Refresh the page to reflect deletion
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function updateRole(userId, newRole) {
            if (!confirm("Are you sure you want to change this user's role?")) {
                return;
            }

            fetch('update_role.php', {
                method: 'POST',
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${userId}&role=${newRole}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.message === "User role updated successfully") {
                    location.reload(); // Refresh the page after role update
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</body>
</html>
