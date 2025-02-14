<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">News Details</h1>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-sm p-4">
        <h3><?= htmlspecialchars($news['name']); ?></h3>

        <div class="mb-3">
            <strong>Status:</strong> 
            <span class="badge <?= $news['status'] === 'active' ? 'bg-success' : 'bg-danger' ?>">
                <?= ucfirst(htmlspecialchars($news['status'])) ?>
            </span>
        </div>

        <div class="mb-3">
            <strong>Start Date:</strong> <?= htmlspecialchars($news['date']); ?>
        </div>

        <div class="mb-3">
            <strong>End Date:</strong> <?= htmlspecialchars($news['end_date']); ?>
        </div>

        <div class="mb-3">
            <strong>Description:</strong>
            <p><?= nl2br(htmlspecialchars($news['description'])); ?></p>
        </div>

        <div class="d-flex justify-content-between">
            <a href="edit.php?id=<?= $news['id']; ?>" class="btn btn-primary">Edit</a>
            <a href="delete.php?id=<?= $news['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this news article?')">Delete</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
