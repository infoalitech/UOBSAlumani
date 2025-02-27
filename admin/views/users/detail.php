<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">User Details</h1>
        <a href="<?= $basePath ?>/admin/users" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-lg p-4">
        <!-- User Name & Email -->
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary"><?= htmlspecialchars($user['name']); ?></h2>
            <p class="text-muted"><?= htmlspecialchars($user['email']); ?></p>
        </div>
        <div class="mb-3">
            <strong>Status:</strong> 
            <?= $user['active'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'; ?>
        </div>

        <!-- User Permissions -->
        <div class="mb-3">
            <strong>Permissions:</strong>
            <ul>
                <?php if (!empty($user['permissions'])): ?>
                    <?php foreach ($user['permissions'] as $permission): ?>
                        <li><?= htmlspecialchars($permission['name']); ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="text-muted">No permissions assigned</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <a href="<?= $basePath ?>/admin/users/edit?id=<?= $user['id']; ?>" class="btn btn-warning">Edit User</a>
            <a href="<?= $basePath ?>/admin/users/delete?id=<?= $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
