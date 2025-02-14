<?php
$title = $blog['title'];
include 'snippets/header.php';
?>


<div class="container mt-4">
    <h1 class="text-center"><?= htmlspecialchars($blog['title']) ?></h1>
    <img src="<?= $basePath ?>/<?= $blog['cover'] ?>" class="img-fluid my-3" alt="<?= htmlspecialchars($blog['title']) ?>">
    
    <p><strong>Published on:</strong> <?= htmlspecialchars($blog['published_date']) ?></p>
    <p><?= nl2br(htmlspecialchars($blog['description'])) ?></p>
</div>

<?php include 'snippets/footer.php'; ?>
