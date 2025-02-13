<?php
// filepath: /Applications/AMPPS/www/UOBSAlumani/php-crud-app/admin/views/news/index.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>News</title>
</head>
<body>
    <h1>News</h1>
    <a href="create.php">Create News</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($news as $newsItem): ?>
                <tr>
                    <td><?php echo $newsItem['id']; ?></td>
                    <td><?php echo $newsItem['name']; ?></td>
                    <td><?php echo $newsItem['status']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $newsItem['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $newsItem['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>