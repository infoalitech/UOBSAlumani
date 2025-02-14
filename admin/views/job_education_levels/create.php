<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Add New Job Education Level</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="level" class="form-label">Education Level:</label>
            <input type="text" id="level" name="level" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="<?= $basePath ?>/admin/jobs/education" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
