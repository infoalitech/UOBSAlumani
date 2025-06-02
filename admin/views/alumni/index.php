<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Alumni Management</h1>
        <a href="<?= $basePath ?>/admin/alumni/create" class="btn btn-primary">Add User</a>
    </div>

    <table id="alumniTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Active</th>
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
                Are you sure you want to delete this user?
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
    let table = $('#alumniTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "alumni/fetch",
            "type": "GET",
            "dataSrc": function(json) {
                return json.data;
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "status",
"render": function(data, type, row) {
    let statusClass = {
        'active': 'success',
        'inactive': 'danger',
        'pending': 'warning'
    };

    return `<span class="badge bg-${statusClass[row.status] || 'secondary'}">${row.status}</span>`;
}

             },
            {
                "data": "active",
                "render": function(data) {
                    return data == 1 
                        ? '<span class="badge bg-success">Active</span>' 
                        : '<span class="badge bg-danger">Inactive</span>';
                }
            },
            {
                "data": "id",
                "render": function(data) {
                    return `
                        <div class="btn-group mt-2">

                        <a href="${basePath}/admin/alumni/edit?id=${data}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="${basePath}/admin/alumni/detail?id=${data}" class="btn btn-sm btn-info">View</a>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="${data}">
                            Delete
                        </button>
                        </div>

                        <div class="btn-group mt-2">
                            <a href="${basePath}/admin/alumni/status?id=${data}&status=active" class="btn btn-sm btn-success">Approve</a>
                            <a href="${basePath}/admin/alumni/status?id=${data}&status=inactive" class="btn btn-sm btn-danger">Reject</a>
                            <a href="${basePath}/admin/alumni/status?id=${data}&status=pending" class="btn btn-sm btn-secondary">Pending</a>
                        </div>
                        `;
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
        $('#confirmDelete').attr('href', `${basePath}/admin/alumni/delete?id=${id}`);
    });
});
</script>
