<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Job Posts</h1>
        <a href="<?= $basePath ?>/admin/jobs/create" class="btn btn-primary">Add New Type</a>
    </div>

    <table id="jobPostsTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Organization</th>
                <th>Category</th>
                <th>Field</th>
                <th>Education Level</th>
                <th>Type</th>
                <th>Country</th>
                <th>Open Date</th>
                <th>Last Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

<script>
$(document).ready(function () {
    $('#jobPostsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "jobs/fetch",
            "type": "GET",
            "dataSrc": function(json) {
                return json.data;
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "title" },
            { "data": "organization" },
            { "data": "category_name" },
            { "data": "field_name" },
            { "data": "education_level" },
            { "data": "type_name" },
            { "data": "country" },
            { "data": "open_date" },
            { "data": "last_date" },
            {
                "data": "id",
                "render": function(data) {
                    return `
                        <a href="${basePath}/admin/jobs/edit?id=${data}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="${basePath}/admin/jobs/detail?id=${data}" class="btn btn-sm btn-info">View</a>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="${data}">
                            Delete
                        </button>`;
                }
            }
        ]
    });
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        $('#confirmDelete').attr('href', `${basePath}/admin/jobs/delete?id=${id}`);
    });
});
</script>
