<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Create Blog</h1>
        <a href="<?= $basePath ?>/admin/blogs" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-sm p-4">
        <form method="POST" action="<?= $basePath ?>/admin/blogs/create"  enctype="multipart/form-data">

            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cover" class="form-label">Cover Image:</label>
                <input type="file" id="cover" name="cover" class="form-control" accept="image/*" required>
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="published_date" class="form-label">Published Date:</label>
                <input type="date" id="published_date" name="published_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cat_id" class="form-label">Category:</label>
                <select id="cat_id" name="cat_id" class="form-select" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
