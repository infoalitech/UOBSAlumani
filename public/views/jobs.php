<?php
$title = 'Job Opportunities';
include 'snippets/header.php';
?>


<div class="container mt-4">
    <h1 class="text-center">Job Opportunities</h1>

    <ul class="list-group">
        <?php foreach ($jobs as $job): ?>
            <li class="list-group-item">
                <a href="jobsDetail.php?id=<?= $job['id'] ?>"><?= htmlspecialchars($job['title']) ?> - <?= htmlspecialchars($job['organization']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include 'snippets/footer.php'; ?>
