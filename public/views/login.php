<?php
$title = 'Login';
include 'snippets/header.php';
?>


<div class="container mt-4">
    <h1 class="text-center">Login</h1>
    <div class="row justify-content-center"
        <div class="col-md-8">
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
    </div>
</div>

<?php include 'snippets/footer.php'; ?>
