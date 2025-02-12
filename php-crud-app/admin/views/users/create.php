
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>
    <form method="POST" action="create.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="active">Active:</label>
        <input type="checkbox" id="active" name="active" value="1">
        <br>
        <button type="submit">Create</button>
    </form>
</body>
</html>