<?php
session_start();
$title = 'Login';
include 'snippets/header.php';
include 'snippets/navigation.php';
?>
<div class="container">
    <h1>Login</h1>
    <form method="POST" action="/UOBSAlumani/php-crud-app/public/login_handler.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
<?php include 'snippets/footer.php'; ?>