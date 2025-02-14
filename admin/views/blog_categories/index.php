<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Blog Categories</h1>
        <a href="create.php" class="btn btn-primary">Add New Category</a>
    </div>

    <table id="blogCategoriesTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody> <!-- AJAX will populate this -->
    </table>
</div>

<script>
$(document).ready(function () {
    $('#blogCategoriesTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "fetchCategories.php",
            "type": "GET",
            "dataSrc": function(json) {
                return json.data;
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            {
                "data": "id",
                "render": function(data) {
                    return `
                        <a href="edit.php?id=${data}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="detail.php?id=${data}" class="btn btn-sm btn-info">View</a>
                        <a href="delete.php?id=${data}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>`;
                }
            }
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "responsive": true
    });
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
