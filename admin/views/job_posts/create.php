<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Create New Job Post</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <!-- Left Column -->
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
                <div class="mb-3 col-md-6">
                    <label for="description" class="form-label">Job Description</label>
                    <textarea name="description" class="form-control" rows="5" required></textarea>
                </div>

                <!-- Requirement -->
                <div class="mb-3 col-md-6">
                    <label for="requirement" class="form-label">Job Requirement</label>
                    <textarea name="requirement" class="form-control" rows=5" required></textarea>
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
        <input type="hidden" name="inserted_by" value="<?= $_SESSION['user_id'] ?? 1 ?>">

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">Create Job Post</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
