<?php
$title = 'Job Posts';
include 'snippets/header.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Job Posts</h1>
        <a href="<?= $basePath ?>/admin/jobs/create" class="btn btn-primary">Add New Job</a>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this job post?
        </div>
        <div class="modal-footer">
            <a href="#" id="confirmDelete" class="btn btn-danger">Yes, Delete</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
    </div>
  </div>
</div>

<script>
    const basePath = "<?= $basePath ?>";

    $(document).ready(function () {
        $('#jobPostsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": basePath + "/admin/jobs/fetch",
                "type": "GET",
                "dataSrc": function (json) {
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
                    "render": function (data) {
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
            const button = $(event.relatedTarget);
            const id = button.data('id');
            $('#confirmDelete').attr('href', `${basePath}/admin/jobs/delete?id=${id}`);
        });
    });
</script>

<?php include 'snippets/footer.php'; ?>
