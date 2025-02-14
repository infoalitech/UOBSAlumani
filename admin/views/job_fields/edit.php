<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Edit Job Field</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Field Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($field['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select id="status" name="status" class="form-select">
                <option value="active" <?= ($field['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?= ($field['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
