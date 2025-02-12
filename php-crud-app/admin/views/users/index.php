<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>
<body>
    <h1>Users</h1>
    <a href="create.php">Create User</a>
    <table>
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
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['active']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>