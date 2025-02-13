<?php
// filepath: /Applications/AMPPS/www/UOBSAlumani/php-crud-app/admin/views/blogs/edit.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Blog</title>
</head>
<body>
    <h1>Edit Blog</h1>
    <form method="POST" action="edit.php?id=<?php echo $blog['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $blog['title']; ?>" required>
        <br>
        <label for="cover">Cover:</label>
        <input type="text" id="cover" name="cover" value="<?php echo $blog['cover']; ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $blog['description']; ?></textarea>
        <br>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="<?php echo $blog['status']; ?>" required>
        <br>
        <label for="published_date">Published Date:</label>
        <input type="date" id="published_date" name="published_date" value="<?php echo $blog['published_date']; ?>" required>
        <br>
        <label for="cat_id">Category:</label>
        <select id="cat_id" name="cat_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $blog['cat_id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>