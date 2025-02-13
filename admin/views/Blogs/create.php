<?php
// filepath: /Applications/AMPPS/www/UOBSAlumani/php-crud-app/admin/views/blogs/create.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Blog</title>
</head>
<body>
    <h1>Create Blog</h1>
    <form method="POST" action="create.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="cover">Cover:</label>
        <input type="text" id="cover" name="cover" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" required>
        <br>
        <label for="published_date">Published Date:</label>
        <input type="date" id="published_date" name="published_date" required>
        <br>
        <label for="cat_id">Category:</label>
        <select id="cat_id" name="cat_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Create</button>
    </form>
</body>
</html>