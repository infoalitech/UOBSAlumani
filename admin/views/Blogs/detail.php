<?php
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Blog Details</h1>
        <a href="<?= $basePath ?>/admin/blogs" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-sm p-4">
        <div class="mb-3">
            <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
        </div>

        <div class="mb-3">
            <img src="<?= $basePath ?>/../<?php echo htmlspecialchars($blog['cover']); ?>" width="300px" class="img-fluid rounded" alt="Blog Cover">
        </div>

        <div class="mb-3">
            <label class="fw-bold">Description:</label>
            <p><?php echo nl2br(htmlspecialchars($blog['description'])); ?></p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Status:</label>
            <span class="badge <?php echo ($blog['status'] === 'published') ? 'bg-success' : 'bg-warning'; ?>">
                <?php echo ucfirst(htmlspecialchars($blog['status'])); ?>
            </span>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Published Date:</label>
            <p><?php echo htmlspecialchars($blog['published_date']); ?></p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Category:</label>
            <p><?php echo htmlspecialchars($blog['category_name']); ?></p>
        </div>

        <div class="d-flex justify-content-between">
            <a href="<?= $basePath ?>/admin/blogs/edit?id=<?php echo $blog['id']; ?>" class="btn btn-primary">Edit</a>
            <a href="<?= $basePath ?>/admin/blogs/delete?id=<?php echo $blog['id']; ?>" class="btn btn-danger">Delete</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
