<?php
$title = 'Login';
include 'snippets/header.php';
?>


<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1>Login</h1>
    </div>
</div><!-- End Page Title -->

<!-- Features Section -->
<section id="features" class="features section">
  <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="<?= $basePath ?>/login_handler">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group p-2 text-right">
                    <button type="submit" class=" ml-auto btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</section><!-- /Features Section -->



<?php include 'snippets/footer.php'; ?>
