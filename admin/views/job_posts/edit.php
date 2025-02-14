<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Edit Job Post</h1>

    <form method="POST"  enctype="multipart/form-data">
        <div class="row">
            <!-- Job Title -->
            <div class="mb-3 col-md-8">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($jobPost['title']) ?>" required>
            </div>

            <!-- Organization -->
            <div class="mb-3 col-md-4">
                <label for="organization" class="form-label">Organization</label>
                <input type="text" name="organization" class="form-control" value="<?= htmlspecialchars($jobPost['organization']) ?>" required>
            </div>

            <!-- Description -->
            <div class="mb-3 col-md-6">
                <label for="description" class="form-label">Job Description</label>
                <textarea name="description" class="form-control" rows="5" required><?= htmlspecialchars($jobPost['description']) ?></textarea>
            </div>

            <!-- Requirements -->
            <div class="mb-3 col-md-6">
                <label for="requirement" class="form-label">Job Requirement</label>
                <textarea name="requirement" class="form-control" rows="5" required><?= htmlspecialchars($jobPost['requirement']) ?></textarea>
            </div>

            <!-- Category -->
            <div class="mb-3 col-md-3">
                <label for="category_id" class="form-label">Job Category</label>
                <select name="category_id" class="form-select" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= ($category['id'] == $jobPost['category_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Field -->
            <div class="mb-3 col-md-3">
                <label for="field_id" class="form-label">Job Field</label>
                <select name="field_id" class="form-select" required>
                    <?php foreach ($fields as $field): ?>
                        <option value="<?= $field['id'] ?>" <?= ($field['id'] == $jobPost['field_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($field['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Education Level -->
            <div class="mb-3 col-md-3">
                <label for="level_id" class="form-label">Education Level</label>
                <select name="level_id" class="form-select" required>
                    <?php foreach ($levels as $level): ?>
                        <option value="<?= $level['id'] ?>" <?= ($level['id'] == $jobPost['level_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($level['level']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Job Type -->
            <div class="mb-3 col-md-3">
                <label for="type_id" class="form-label">Job Type</label>
                <select name="type_id" class="form-select" required>
                    <?php foreach ($types as $type): ?>
                        <option value="<?= $type['id'] ?>" <?= ($type['id'] == $jobPost['type_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($type['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Country -->
            <div class="mb-3 col-md-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($jobPost['country']) ?>" required>
            </div>

            <!-- Open Date -->
            <div class="mb-3 col-md-3">
                <label for="open_date" class="form-label">Open Date</label>
                <input type="date" name="open_date" class="form-control" value="<?= htmlspecialchars($jobPost['open_date']) ?>" required>
            </div>

            <!-- Last Date -->
            <div class="mb-3 col-md-3">
                <label for="last_date" class="form-label">Last Date</label>
                <input type="date" name="last_date" class="form-control" value="<?= htmlspecialchars($jobPost['last_date']) ?>" required>
            </div>

            <!-- Post Link -->
            <div class="mb-3 col-md-3">
                <label for="post_link" class="form-label">Post Link (Optional)</label>
                <input type="url" name="post_link" class="form-control" value="<?= htmlspecialchars($jobPost['post_link']) ?>">
            </div>

            <!-- Apply Link -->
            <div class="mb-3 col-md-3">
                <label for="apply_link" class="form-label">Apply Link (Optional)</label>
                <input type="url" name="apply_link" class="form-control" value="<?= htmlspecialchars($jobPost['apply_link']) ?>">
            </div>

            <!-- Image Upload -->
            <div class="mb-3 col-md-3">
                <label for="image" class="form-label">Change Job Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <!-- Job Image Preview -->
            <?php if (!empty($jobPost['image'])): ?>
                <div class="mb-3 col-md-3">
                    <label class="form-label">Current Job Image</label><br>
                    <img src="<?= $jobPost['image'] ?>" alt="Job Image" class="img-thumbnail" width="200">
                </div>
            <?php endif; ?>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-warning btn-lg">Update Job Post</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
