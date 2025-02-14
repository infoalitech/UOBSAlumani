<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1>Add New Job Type</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Type Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
