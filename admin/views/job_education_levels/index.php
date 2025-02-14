<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Job Education Levels</h1>
        <a href="create.php" class="btn btn-primary">Add New Level</a>
    </div>

    <table id="jobEducationLevelsTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($educationLevels as $level): ?>
                <tr>
                    <td><?= $level['id'] ?></td>
                    <td><?= htmlspecialchars($level['level']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $level['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="detail.php?id=<?= $level['id'] ?>" class="btn btn-info btn-sm">View</a>
                        <a href="delete.php?id=<?= $level['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this level?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function () {
    $('#jobEducationLevelsTable').DataTable();
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
