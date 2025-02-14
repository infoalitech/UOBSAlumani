<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Job Type Details</h1>
    <a href="index.php" class="btn btn-secondary">Back</a>

    <div class="card shadow-sm p-4">
        <h3><?= htmlspecialchars($type['name']); ?></h3>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
