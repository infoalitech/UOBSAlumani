<?php
$title = $blog['title'];
include 'snippets/header.php';
?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1><?= htmlspecialchars($blog['title']) ?></h1>
        <p>
           Published Date: <?= htmlspecialchars($blog['published_date']) ?>
        </p>
        
    </div>
</div><!-- End Page Title -->

<!-- Features Section -->
<section id="features" class="features section">
  <div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <strong>Description:</strong>
            <div>
                <?= !empty($blog['description']) ? $blog['description'] : '<em>No description provided.</em>' ?>
            </div>
        </div>
        <div class="col-md-6">
            <?php if ($blog['cover']){ ?>
                <img src="<?= $basePath ?>/../<?php echo htmlspecialchars($blog['cover']); ?>" class="card-img-top" alt="<?= htmlspecialchars($blog['title']) ?>">
            <?php } else { ?>
                <img src="https://uobs.edu.pk/images/main/sarfaranga.jpg" class="card-img-top" alt="<?= htmlspecialchars($blog['title']) ?>">
            <?php } ?>
        </div>
    </div>
  </div>
</section><!-- /Features Section -->


<?php include 'snippets/footer.php'; ?>


<?php include 'snippets/footer.php'; ?>


<div class="container mt-4">
    <h1 class="text-center"><?= htmlspecialchars($blog['title']) ?></h1>
    <img src="<?= $basePath ?>/<?= $blog['cover'] ?>" class="img-fluid my-3" alt="<?= htmlspecialchars($blog['title']) ?>">
    
    <p><strong>Published on:</strong> <?= htmlspecialchars($blog['published_date']) ?></p>
    <p><?= nl2br(htmlspecialchars($blog['description'])) ?></p>
</div>

<?php include 'snippets/footer.php'; ?>
