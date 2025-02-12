<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="update.php?id=<?php echo htmlspecialchars($user->id); ?>" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user->name); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user->email); ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Update User</button>
                <a href="index.php" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>