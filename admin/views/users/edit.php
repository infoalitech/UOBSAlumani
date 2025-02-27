<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Edit User <?= $user['name'] ?></h1>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="active" class="form-label">Status:</label>
            <select id="active" name="active" class="form-select">
                <option value="1" <?= $user['active'] == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= $user['active'] == 0 ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <!-- Permissions (Multiple Selection) -->
        <div class="mb-3">
            <label for="permission_ids" class="form-label">Permissions</label>
            <select name="permission_ids[]" class="form-select" multiple required>
                <?php foreach ($permissions as $permission): ?>
                    <option value="<?= htmlspecialchars($permission['id']) ?>" 
                        <?= (isset($userPermissions) && in_array($permission['id'], array_column($userPermissions, 'id'))) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($permission['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
