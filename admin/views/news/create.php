<?php
// filepath: /Applications/AMPPS/www/UOBSAlumani/php-crud-app/admin/views/news/create.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create News</title>
</head>
<body>
    <h1>Create News</h1>
    <form method="POST" action="create.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="desc">Description:</label>
        <textarea id="desc" name="desc" required></textarea>
        <br>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <br>
        <button type="submit">Create</button>
    </form>
</body>
</html>