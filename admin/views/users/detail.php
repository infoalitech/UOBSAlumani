<?php
require_once '../../../config/database.php';
require_once '../../models/User.php';

$userId = $_GET['id'] ?? null;

if ($userId) {
    $user = new User();
    $userData = $user->find($userId);

    if (!$userData) {
        die('User not found.');
    }
} else {
    die('Invalid user ID.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>User Details</h1>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($userData->id); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($userData->name); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userData->email); ?></p>
        <a href="index.php" class="btn">Back to User List</a>
    </div>
</body>
</html>