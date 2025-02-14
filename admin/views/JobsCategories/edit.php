<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Edit Job Category</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $category['name']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select id="status" name="status" class="form-select">
                <option value="active" <?php echo $category['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?php echo $category['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
