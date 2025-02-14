<?php
$title = $job['title'];
include 'snippets/header.php';
?>


<div class="container mt-4">
    <h1 class="text-center"><?= htmlspecialchars($job['title']) ?></h1>
    <p><strong>Organization:</strong> <?= htmlspecialchars($job['organization']) ?></p>
    <p><strong>Category:</strong> <?= htmlspecialchars($job['category_name']) ?></p>
    <p><strong>Country:</strong> <?= htmlspecialchars($job['country']) ?></p>
    <p><strong>Open Date:</strong> <?= htmlspecialchars($job['open_date']) ?></p>
    <p><strong>Last Date:</strong> <?= htmlspecialchars($job['last_date']) ?></p>
    <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($job['description'])) ?></p>

    <a href="<?= htmlspecialchars($job['apply_link']) ?>" class="btn btn-success" target="_blank">Apply Now</a>
</div>

<?php include 'snippets/footer.php'; ?>
