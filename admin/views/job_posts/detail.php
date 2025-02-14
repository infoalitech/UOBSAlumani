<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Job Post Details</h1>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-sm p-4">
        <h3 class="mb-3"><?= htmlspecialchars($jobPost['title']); ?></h3>

        <div class="mb-3">
            <strong>Organization:</strong> <?= htmlspecialchars($jobPost['organization']); ?>
        </div>

        <div class="mb-3">
            <strong>Category:</strong> <?= htmlspecialchars($jobPost['category_name']); ?>
        </div>

        <div class="mb-3">
            <strong>Field:</strong> <?= htmlspecialchars($jobPost['field_name']); ?>
        </div>

        <div class="mb-3">
            <strong>Education Level:</strong> <?= htmlspecialchars($jobPost['education_level']); ?>
        </div>

        <div class="mb-3">
            <strong>Job Type:</strong> <?= htmlspecialchars($jobPost['type_name']); ?>
        </div>

        <div class="mb-3">
            <strong>Country:</strong> <?= htmlspecialchars($jobPost['country']); ?>
        </div>

        <div class="mb-3">
            <strong>Open Date:</strong> <?= htmlspecialchars($jobPost['open_date']); ?>
        </div>

        <div class="mb-3">
            <strong>Last Date:</strong> <?= htmlspecialchars($jobPost['last_date']); ?>
        </div>

        <div class="mb-3">
            <strong>Description:</strong>
            <p><?= nl2br(htmlspecialchars($jobPost['description'])); ?></p>
        </div>

        <div class="mb-3">
            <strong>Requirements:</strong>
            <p><?= nl2br(htmlspecialchars($jobPost['requirement'])); ?></p>
        </div>

        <div class="mb-3">
            <strong>Post Link:</strong>
            <a href="<?= htmlspecialchars($jobPost['post_link']); ?>" target="_blank"><?= htmlspecialchars($jobPost['post_link']); ?></a>
        </div>

        <div class="mb-3">
            <strong>Apply Link:</strong>
            <a href="<?= htmlspecialchars($jobPost['apply_link']); ?>" target="_blank"><?= htmlspecialchars($jobPost['apply_link']); ?></a>
        </div>

        <div class="d-flex justify-content-between">
            <a href="edit.php?id=<?= $jobPost['id']; ?>" class="btn btn-primary">Edit</a>
            <a href="delete.php?id=<?= $jobPost['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this job post?')">Delete</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
