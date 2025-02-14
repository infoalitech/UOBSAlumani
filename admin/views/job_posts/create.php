<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Add New Job Post</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Job Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="organization" class="form-label">Organization:</label>
            <input type="text" id="organization" name="organization" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <select id="category_id" name="category_id" class="form-select">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
