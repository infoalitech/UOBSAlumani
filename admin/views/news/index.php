<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">News Management</h1>
        <a href="create.php" class="btn btn-primary">Add News</a>
    </div>

    <table id="newsTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
$(document).ready(function () {
    $('#newsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "fetchNews.php",
            "type": "GET",
            "dataSrc": function(json) {
                return json.data;
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "status" },
            { "data": "date" },
            { "data": "end_date" },
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
