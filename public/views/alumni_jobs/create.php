<?php
$title = 'Create New Job Post';
include(__DIR__.'/../snippets/header.php');
?>
<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1>Create Job Post</h1>
        <p>
        Create New Job Post
        </p>
        
    </div>
</div><!-- End Page Title -->

<div class="container mt-4">
    <h1 class="mb-4">Create New Job Post</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= $basePath ?>/alumni/job/store" enctype="multipart/form-data">
        <div class="row">
            <!-- Title -->
            <div class="mb-3 col-md-8">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <!-- Organization -->
            <div class="mb-3 col-md-4">
                <label for="organization" class="form-label">Organization</label>
                <input type="text" name="organization" class="form-control" required>
            </div>

            <!-- Description -->
            <div class="mb-3 col-12">
                <label for="description" class="form-label">Job Description:</label>
                <div id="editor" style="height: 300px; background-color: #fff;"></div>
                <input type="hidden" name="description" id="description">
            </div>

            <!-- Requirement -->
            <div class="mb-3 col-12">
                <label for="requirement" class="form-label">Job Requirement:</label>
                <div id="editor2" style="height: 300px; background-color: #fff;"></div>
                <input type="hidden" name="requirement" id="requirement">
            </div>

            <!-- Category -->
            <div class="mb-3 col-md-3">
                <label for="category_id" class="form-label">Job Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Field -->
            <div class="mb-3 col-md-3">
                <label for="field_id" class="form-label">Job Field</label>
                <select name="field_id" class="form-select" required>
                    <option value="">Select Field</option>
                    <?php foreach ($fields as $field): ?>
                        <option value="<?= $field['id'] ?>"><?= htmlspecialchars($field['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Education Level -->
            <div class="mb-3 col-md-3">
                <label for="level_id" class="form-label">Education Level</label>
                <select name="level_id" class="form-select" required>
                    <option value="">Select Level</option>
                    <?php foreach ($levels as $level): ?>
                        <option value="<?= $level['id'] ?>"><?= htmlspecialchars($level['level']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Job Type -->
            <div class="mb-3 col-md-3">
                <label for="type_id" class="form-label">Job Type</label>
                <select name="type_id" class="form-select" required>
                    <option value="">Select Type</option>
                    <?php foreach ($types as $type): ?>
                        <option value="<?= $type['id'] ?>"><?= htmlspecialchars($type['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Country -->
            <div class="mb-3 col-md-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" name="country" class="form-control" required>
            </div>

            <!-- Open Date -->
            <div class="mb-3 col-md-3">
                <label for="open_date" class="form-label">Open Date</label>
                <input type="date" name="open_date" class="form-control" required>
            </div>

            <!-- Last Date -->
            <div class="mb-3 col-md-3">
                <label for="last_date" class="form-label">Last Date</label>
                <input type="date" name="last_date" class="form-control" required>
            </div>

            <!-- Post Link -->
            <div class="mb-3 col-md-3">
                <label for="post_link" class="form-label">Post Link (Optional)</label>
                <input type="url" name="post_link" class="form-control">
            </div>

            <!-- Apply Link -->
            <div class="mb-3 col-md-3">
                <label for="apply_link" class="form-label">Apply Link (Optional)</label>
                <input type="url" name="apply_link" class="form-control">
            </div>

            <!-- Image Upload -->
            <div class="mb-3 col-md-3">
                <label for="image" class="form-label">Upload Job Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
        </div>

        <!-- Hidden Fields -->
        <input type="hidden" name="views" value="0">
        <input type="hidden" name="likes" value="0">
        <input type="hidden" name="clicks" value="0">
        <input type="hidden" name="inserted_by" value="<?= $_SESSION['user']['id'] ?? 1 ?>">

        <!-- Submit -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success btn-lg">Create Job Post</button>
        </div>
    </form>
</div>

<!-- Quill -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Write the job description...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ 'header': [1, 2, false] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    const quill2 = new Quill('#editor2', {
        theme: 'snow',
        placeholder: 'Write the job requirements...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ 'header': [1, 2, false] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Copy content to hidden input fields before submit
    document.querySelector('form').addEventListener('submit', function () {
        document.querySelector('#description').value = quill.root.innerHTML;
        document.querySelector('#requirement').value = quill2.root.innerHTML;
    });
</script>

<?php 
include(__DIR__.'/../snippets/footer.php');
?>
