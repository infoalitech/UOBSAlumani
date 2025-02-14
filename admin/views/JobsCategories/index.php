<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Job Categories</h1>
        <a href="create.php" class="btn btn-primary">Add New Category</a>
    </div>

    <table id="jobCategoriesTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
$(document).ready(function () {
    $('#jobCategoriesTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "fetchCategories.php",
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "status" },
            {
                "data": "id",
                "render": function(data) {
                    return `
                        <a href="edit.php?id=${data}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="detail.php?id=${data}" class="btn btn-sm btn-info">View</a>
                        <a href="delete.php?id=${data}" class="btn btn-sm btn-danger">Delete</a>`;
                }
            }
        ]
    });
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
