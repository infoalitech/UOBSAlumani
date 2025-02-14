<?php 
require_once '../layouts/header.php'; // Include the header
require_once '../../config/database.php'; // Include database connection

try {
    // Fetch users from the database
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<h1>Users</h1>
<a href="create.php" class="btn">Create User</a>

<?php if (count($users) > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo $user['active'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo urlencode($user['id']); ?>" class="btn">Edit</a>
                        <a href="delete.php?id=<?php echo urlencode($user['id']); ?>" 
                           class="btn delete"
                           onclick="return confirm('Are you sure you want to delete this user?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>

<?php require_once '../layouts/footer.php'; // Include the footer ?>
