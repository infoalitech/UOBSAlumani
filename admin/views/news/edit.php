<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Edit News Article</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Title:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($news['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="desc" class="form-label">Description:</label>
            <textarea id="desc" name="desc" class="form-control" required><?= htmlspecialchars($news['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select id="status" name="status" class="form-select">
                <option value="draft" <?= $news['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                <option value="published" <?= $news['status'] === 'published' ? 'selected' : '' ?>>Published</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Start Date:</label>
            <input type="date" id="date" name="date" class="form-control" value="<?= htmlspecialchars($news['date']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date:</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="<?= htmlspecialchars($news['end_date']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= $basePath ?>/admin/news" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
