<?php
// filepath: /Applications/AMPPS/www/UOBSAlumani/php-crud-app/admin/views/blogs/index.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blogs</title>
</head>
<body>
    <h1>Blogs</h1>
    <a href="create.php">Create Blog</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td><?php echo $blog['id']; ?></td>
                    <td><?php echo $blog['title']; ?></td>
                    <td><?php echo $blog['cat_id']; ?></td>
                    <td><?php echo $blog['status']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $blog['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $blog['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>