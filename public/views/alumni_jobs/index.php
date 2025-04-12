<?php
$title = 'Create New Job Post';
include(__DIR__.'/../snippets/header.php');
?>
<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1>My Job Posts</h1>
        <p>Post Jobs To Share</p>
        
    </div>
</div><!-- End Page Title -->

<div class="container mt-4">
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
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php

            if (!empty($jobPosts)) {
                 foreach ($jobPosts as $job): ?>
                    <tr>
                        <td><?= htmlspecialchars($job['id']) ?></td>
                        <td><?= htmlspecialchars($job['title']) ?></td>
                        <td><?= htmlspecialchars($job['organization']) ?></td>
                        <td><?= htmlspecialchars($job['category_name']) ?></td>
                        <td><?= htmlspecialchars($job['field_name']) ?></td>
                        <td><?= htmlspecialchars($job['education_level']) ?></td>
                        <td><?= htmlspecialchars($job['type_name']) ?></td>
                        <td><?= htmlspecialchars($job['country']) ?></td>
                        <td><?= htmlspecialchars($job['open_date']) ?></td>
                        <td><?= htmlspecialchars($job['last_date']) ?></td>
                        <td><?= htmlspecialchars($job['status']) ?></td>
                    </tr>
                <?php endforeach;
            } else {
                echo '<tr><td colspan="11" class="text-center">No job posts found.</td></tr>';
            }
            ?>

        </tbody>
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


<?php 
include(__DIR__.'/../snippets/footer.php');
?>
