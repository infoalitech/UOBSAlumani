<?php
session_start();
require_once '../src/config/database.php';
require_once '../src/models/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $user = new User($db);
    $user->email = $email;
    $user->name = $name;
    $user->password = password_hash($password, PASSWORD_DEFAULT);

    if ($user->register()) {
        $_SESSION['message'] = "Registration successful! You can now log in.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>