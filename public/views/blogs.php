<?php
$title = 'Blogs';
include 'snippets/header.php';
?>

<div class="container mt-4">
    <h1 class="text-center">Latest Blogs</h1>
    
    <div class="row">
        <?php foreach ($blogs as $blog): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="<?= $basePath ?>/<?= $blog['cover'] ?>" class="card-img-top" alt="<?= htmlspecialchars($blog['title']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($blog['title']) ?></h5>
                        <p class="card-text"><?= substr(strip_tags($blog['description']), 0, 100) ?>...</p>
                        <a href="blogDetail.php?id=<?= $blog['id'] ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'snippets/footer.php'; ?>
