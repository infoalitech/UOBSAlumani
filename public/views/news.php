<?php
$title = 'Latest News';
include 'snippets/header.php';
?>


<div class="container mt-4">
    <h1 class="text-center">Latest News</h1>
    <ul class="list-group">
        <?php foreach ($news as $newsItem): ?>
            <li class="list-group-item">
                <a href="newsDetail.php?id=<?= $newsItem['id'] ?>"><?= htmlspecialchars($newsItem['name']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include 'snippets/footer.php'; ?>
