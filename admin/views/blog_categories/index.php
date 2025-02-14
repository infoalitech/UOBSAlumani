<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Blog Categories</h1>
        <a href="<?= $basePath ?>/admin/blog/categories/create" class="btn btn-primary">Add New Category</a>
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
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this blog?
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
    $('#blogCategoriesTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "categories/fetch",
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
                        <a href="${basePath}/admin/blog/categories/edit?id=${data}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="${basePath}/admin/blog/categories/detail?id=${data}" class="btn btn-sm btn-info">Detail</a>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" data-id="${data}">
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
        $('#confirmDelete').attr('href', 'categories/delete?id=' + id);
    });
});
</script>

