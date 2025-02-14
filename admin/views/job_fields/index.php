<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Job Fields</h1>
        <a href="create.php" class="btn btn-primary">Add New Field</a>
    </div>

    <table id="jobFieldsTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fields as $field): ?>
                <tr>
                    <td><?= $field['id'] ?></td>
                    <td><?= htmlspecialchars($field['name']) ?></td>
                    <td>
                        <span class="badge <?= ($field['status'] === 'active') ? 'bg-success' : 'bg-danger'; ?>">
                            <?= ucfirst($field['status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $field['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="detail.php?id=<?= $field['id'] ?>" class="btn btn-info btn-sm">View</a>
                        <a href="delete.php?id=<?= $field['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function () {
    $('#jobFieldsTable').DataTable();
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
