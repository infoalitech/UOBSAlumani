<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Job Field Details</h1>
    <a href="index.php" class="btn btn-secondary">Back</a>

    <div class="card shadow-sm p-4">
        <h3><?= htmlspecialchars($field['name']); ?></h3>
        <p><strong>Status:</strong> 
            <span class="badge <?= ($field['status'] === 'active') ? 'bg-success' : 'bg-danger'; ?>">
                <?= ucfirst($field['status']) ?>
            </span>
        </p>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
