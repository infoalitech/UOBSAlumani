<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Job Post Details</h1>
        <a href="<?= $basePath ?>/admin/jobs" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-lg p-4">
        <!-- Job Title -->
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary"><?= htmlspecialchars($jobPost['title']); ?></h2>
            <p class="text-muted"><?= htmlspecialchars($jobPost['organization']); ?></p>
        </div>

        <!-- Job Image -->
        <?php if (!empty($jobPost['image'])): ?>
            <div class="text-center mb-4">
                <img src="<?= htmlspecialchars($jobPost['image']) ?>" alt="Job Image" class="img-fluid rounded shadow-sm" style="max-width: 500px;">
            </div>
        <?php endif; ?>

        <!-- Job Details Grid -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3"><strong>Category:</strong> <?= htmlspecialchars($jobPost['category_name']); ?></div>
                <div class="mb-3"><strong>Field:</strong> <?= htmlspecialchars($jobPost['field_name']); ?></div>
                <div class="mb-3"><strong>Education Level:</strong> <?= htmlspecialchars($jobPost['education_level']); ?></div>
                <div class="mb-3"><strong>Job Type:</strong> <?= htmlspecialchars($jobPost['type_name']); ?></div>
            </div>
            <div class="col-md-6">
                <div class="mb-3"><strong>Country:</strong> <?= htmlspecialchars($jobPost['country']); ?></div>
                <div class="mb-3"><strong>Open Date:</strong> <?= htmlspecialchars($jobPost['open_date']); ?></div>
                <div class="mb-3"><strong>Last Date:</strong> <?= htmlspecialchars($jobPost['last_date']); ?></div>
            </div>
        </div>

        <!-- Description & Requirements -->
        <div class="mb-3">
            <h5 class="text-primary">Description</h5>
            <p class="border rounded p-3 bg-light"><?= nl2br(htmlspecialchars($jobPost['description'])); ?></p>
        </div>

        <div class="mb-3">
            <h5 class="text-primary">Requirements</h5>
            <p class="border rounded p-3 bg-light"><?= nl2br(htmlspecialchars($jobPost['requirement'])); ?></p>
        </div>

        <!-- Post & Apply Links -->
        <div class="d-flex gap-3 mb-4">
            <?php if (!empty($jobPost['post_link'])): ?>
                <a href="<?= htmlspecialchars($jobPost['post_link']); ?>" target="_blank" class="btn btn-outline-primary w-100">View Job Post</a>
            <?php endif; ?>
            <?php if (!empty($jobPost['apply_link'])): ?>
                <a href="<?= htmlspecialchars($jobPost['apply_link']); ?>" target="_blank" class="btn btn-success w-100">Apply Now</a>
            <?php endif; ?>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <a href="<?= $basePath ?>/admin/jobs/edit?id=<?= $jobPost['id']; ?>" class="btn btn-warning">Edit Job</a>
            <a href="<?= $basePath ?>/admin/jobs/delete?id=<?= $jobPost['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this job post?')">Delete Job</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
