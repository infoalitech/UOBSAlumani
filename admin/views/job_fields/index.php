<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Job Fields</h1>
        <a href="<?= $basePath ?>/admin/job/fields/create" class="btn btn-primary">Add New Field</a>
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
        <tbody></tbody> <!-- AJAX will populate this -->
    </table>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this job field?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="confirmDelete" href="#" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

<script>
$(document).ready(function () {
    let table = $('#jobFieldsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "fields/fetch",
            "type": "GET",
            "dataSrc": function(json) {
                return json.data;
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            {
                "data": "status",
                "render": function(data) {
                    return `<span class="badge ${data === 'active' ? 'bg-success' : 'bg-danger'}">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
                }
            },
            {
                "data": "id",
                "render": function(data) {
                    return `
                        <a href="${basePath}/admin/job/fields/edit?id=${data}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="${basePath}/admin/job/fields/detail?id=${data}" class="btn btn-sm btn-info">View</a>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="${data}">
                            Delete
                        </button>`;
                }
            }
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "responsive": true
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        $('#confirmDelete').attr('href', `${basePath}/admin/job/fields/delete?id=${id}`);
    });
});
</script>
