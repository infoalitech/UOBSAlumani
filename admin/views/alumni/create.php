<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Edit User</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control" value="" required>
        </div>

        <div class="mb-3">
            <label for="active" class="form-label">Status:</label>
            <select id="active" name="active" class="form-select">
                <option value="1" >Active</option>
                <option value="0" >Inactive</option>
            </select>
        </div>

        <!-- Job Type -->
        <div class="mb-3">
            <label for="permission_id" class="form-label">Permissions</label>
            <select name="permission_id" class="form-select" required>
                <option value="">Select Type</option>
                <?php foreach ($permissions as $permission): ?>
                    <option value="<?= $permission['id'] ?>"><?= htmlspecialchars($permission['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
