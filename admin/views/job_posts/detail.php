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


    <div class="row">
        <div class="col-md-6">
            <ul class="nav nav-tabs" id="jobTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="text-dark nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab">Basic Info</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="text-dark nav-link" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab">Description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="text-dark nav-link" id="req-tab" data-bs-toggle="tab" data-bs-target="#requirement" type="button" role="tab">Requirement</button>
            </li>
            </ul>

            <div class="tab-content pt-3" id="jobTabContent">
            <!-- Basic Info Tab -->
            <div class="tab-pane fade show active" id="basic" role="tabpanel">
                <p><strong>Title:</strong> <?= htmlspecialchars($jobPost['title']) ?></p>
                <p><strong>Organization:</strong> <?= htmlspecialchars($jobPost['organization']) ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars($jobPost['category_name']) ?></p>
                <p><strong>Field:</strong> <?= htmlspecialchars($jobPost['field_name']) ?></p>
                <p><strong>Type:</strong> <?= htmlspecialchars($jobPost['type_name']) ?></p>
                <p><strong>Education Level:</strong> <?= htmlspecialchars($jobPost['education_level']) ?></p>
                <p><strong>Country:</strong> <?= htmlspecialchars($jobPost['country']) ?></p>
            </div>

            <!-- Description Tab -->
            <div class="tab-pane fade" id="desc" role="tabpanel">
                <p><strong>Description:</strong></p>
                <div><?= !empty($jobPost['description']) ? $jobPost['description'] : '<em>No description provided.</em>' ?></div>
            </div>

            <!-- Requirement Tab -->
            <div class="tab-pane fade" id="requirement" role="tabpanel">
                <p><strong>Requirement:</strong></p>
                <div><?= !empty($jobPost['requirement']) ? $jobPost['requirement'] : '<em>No requirements specified.</em>' ?></div>
            </div>
            </div>


        </div>
        <div class="col-md-6">
            <?php if ($jobPost['image']){ ?>
                <img src="<?= $basePath ?>/../<?php echo htmlspecialchars($jobPost['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($jobPost['title']) ?>">
            <?php } else { ?>
                <img src="https://uobs.edu.pk/images/main/sarfaranga.jpg" class="card-img-top" alt="<?= htmlspecialchars($jobPost['title']) ?>">
            <?php } ?>
        </div>
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
