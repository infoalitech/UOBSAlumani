<?php
$title = $job['title'];
include 'snippets/header.php';
?>


<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1><?= htmlspecialchars($job['title']) ?></h1>

        <p><strong>Open Date:</strong> <?= htmlspecialchars($job['open_date']) ?> 
        <strong>Last Date:</strong> 
        <?= htmlspecialchars($job['last_date']) ?></p>
        <div class="text-right">
            <?php if ($job['apply_link']){ ?>
                    <a href="<?= htmlspecialchars($job['apply_link']) ?>" class="btn btn-success" target="_blank">Apply Now</a>
            <?php } ?>
            <?php if ($job['post_link']){ ?>
                    <a href="<?= htmlspecialchars($job['post_link']) ?>" class="btn btn-success" target="_blank">Source</a>
            <?php } ?>
        </div>
    </div>
</div><!-- End Page Title -->

<!-- Features Section -->
<section id="features" class="features section">
  <div class="container mt-4">
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
                <p><strong>Title:</strong> <?= htmlspecialchars($job['title']) ?></p>
                <p><strong>Organization:</strong> <?= htmlspecialchars($job['organization']) ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars($job['category_name']) ?></p>
                <p><strong>Field:</strong> <?= htmlspecialchars($job['field_name']) ?></p>
                <p><strong>Type:</strong> <?= htmlspecialchars($job['type_name']) ?></p>
                <p><strong>Education Level:</strong> <?= htmlspecialchars($job['education_level']) ?></p>
                <p><strong>Country:</strong> <?= htmlspecialchars($job['country']) ?></p>
            </div>

            <!-- Description Tab -->
            <div class="tab-pane fade" id="desc" role="tabpanel">
                <p><strong>Description:</strong></p>
                <div><?= !empty($job['description']) ? $job['description'] : '<em>No description provided.</em>' ?></div>
            </div>

            <!-- Requirement Tab -->
            <div class="tab-pane fade" id="requirement" role="tabpanel">
                <p><strong>Requirement:</strong></p>
                <div><?= !empty($job['requirement']) ? $job['requirement'] : '<em>No requirements specified.</em>' ?></div>
            </div>
            </div>


        </div>
        <div class="col-md-6">
            <?php if ($job['image']){ ?>
                <img src="<?= $basePath ?>/../<?php echo htmlspecialchars($job['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($job['title']) ?>">
            <?php } else { ?>
                <img src="https://uobs.edu.pk/images/main/sarfaranga.jpg" class="card-img-top" alt="<?= htmlspecialchars($job['title']) ?>">
            <?php } ?>
        </div>
    </div>
  </div>
</section><!-- /Features Section -->



<?php include 'snippets/footer.php'; ?>
