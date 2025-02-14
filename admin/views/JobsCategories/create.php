<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Add Job Category</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select id="status" name="status" class="form-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <a href="<?= $basePath ?>/admin/jobs/categories" class="btn btn-secondary">Back</a>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
