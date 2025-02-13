<?php
// filepath: /Applications/AMPPS/www/UOBSAlumani/php-crud-app/admin/views/news/edit.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit News</title>
</head>
<body>
    <h1>Edit News</h1>
    <form method="POST" action="edit.php?id=<?php echo $news['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $news['name']; ?>" required>
        <br>
        <label for="desc">Description:</label>
        <textarea id="desc" name="desc" required><?php echo $news['description']; ?></textarea>
        <br>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="<?php echo $news['status']; ?>" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $news['date']; ?>" required>
        <br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" value="<?php echo $news['end_date']; ?>" required>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>