<?php
$title = $news['title'];
include 'snippets/header.php';
?>

<div class="container mt-4">
    <h1 class="text-center"><?= htmlspecialchars($news['name']) ?></h1>
    <p><strong>Date:</strong> <?= htmlspecialchars($news['date']) ?></p>
    <p><?= nl2br(htmlspecialchars($news['description'])) ?></p>
</div>

<?php include 'snippets/footer.php'; ?>
