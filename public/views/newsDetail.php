<?php
$title = $news['name'];
include 'snippets/header.php';
?>


<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1><?= htmlspecialchars($news['name']) ?></h1>
        <p><strong>Date:</strong> <?= htmlspecialchars($news['date']) ?></p>
    </div>
</div><!-- End Page Title -->

<!-- Features Section -->
<section id="features" class="features section">
  <div class="container mt-4">
        <p><?= nl2br(htmlspecialchars($news['description'])) ?></p>
  </div>
</section><!-- /Features Section -->


<?php include 'snippets/footer.php'; ?>