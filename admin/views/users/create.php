<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">User Details</h1>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-sm p-4">
        <h3 class="mb-3"><?= htmlspecialchars($user['name']); ?></h3>

        <div class="mb-3">
            <strong>Email:</strong> <?= htmlspecialchars($user['email']); ?>
        </div>

        <div class="mb-3">
            <strong>Role:</strong> <?= htmlspecialchars(ucfirst($user['role'])); ?>
        </div>

        <div class="mb-3">
            <strong>Status:</strong>
            <span class="badge <?= $user['active'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                <?= $user['active'] == 1 ? 'Active' : 'Inactive' ?>
            </span>
        </div>

        <div class="d-flex justify-content-between">
            <a href="edit.php?id=<?= $user['id']; ?>" class="btn btn-primary">Edit</a>
            <a href="delete.php?id=<?= $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
