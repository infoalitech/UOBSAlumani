<?php
$title = 'Change Password';
include 'snippets/header.php';
?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1>Change Password</h1>
        <p>Secure your account by updating your password.</p>

        <?php if (!empty($_SESSION['form_errors'])): ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION['form_errors'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; unset($_SESSION['form_errors']); ?>
            </div>
        <?php elseif (!empty($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<section class="features section">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="<?= $basePath ?>/change_password_handler">
                    <div class="mb-3">
                        <label for="current_password">Current Password:</label>
                        <input type="password" class="form-control" name="current_password" id="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password">New Password:</label>
                        <input type="password" class="form-control" name="new_password" id="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password">Confirm New Password:</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'snippets/footer.php'; ?>
