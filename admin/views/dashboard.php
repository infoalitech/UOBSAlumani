<?php require_once __DIR__ . '/layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4 text-center">Welcome To UOBS Alumni</h1>

    <!-- Stats Grid -->
    <div class="row g-4">
        <?php
        $stats = [
            ['title' => 'Total Users', 'value' => $totalUsers, 'bg' => 'bg-primary'],
            ['title' => 'Total Blog Posts', 'value' => $totalBlogs, 'bg' => 'bg-success'],
            ['title' => 'Total News Articles', 'value' => $totalNews, 'bg' => 'bg-warning'],
            ['title' => 'Total Job Posts', 'value' => $totalJobs, 'bg' => 'bg-danger'],
            ['title' => 'Total Job Categories', 'value' => $totalCategories, 'bg' => 'bg-info'],
            ['title' => 'Total Job Types', 'value' => $totalJobTypes, 'bg' => 'bg-secondary']
        ];
        foreach ($stats as $stat): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card text-white <?= $stat['bg'] ?> shadow-sm h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title"><?= $stat['title'] ?></h5>
                        <p class="card-text display-4"><?= $stat['value'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Engagement Stats -->
    <h2 class="mt-5 mb-3 text-center">Engagement Statistics</h2>
    <div class="row g-4">
        <?php
        $engagementStats = [
            ['title' => 'Blog Views', 'value' => $totalBlogViews, 'bg' => 'bg-light text-dark'],
            ['title' => 'Blog Likes', 'value' => $totalBlogLikes, 'bg' => 'bg-light text-dark'],
            ['title' => 'Blog Clicks', 'value' => $totalBlogClicks, 'bg' => 'bg-light text-dark'],
            ['title' => 'News Views', 'value' => $totalNewsViews, 'bg' => 'bg-light text-dark'],
            ['title' => 'News Likes', 'value' => $totalNewsLikes, 'bg' => 'bg-light text-dark'],
            ['title' => 'News Clicks', 'value' => $totalNewsClicks, 'bg' => 'bg-light text-dark'],
            ['title' => 'Job Views', 'value' => $totalJobViews, 'bg' => 'bg-light text-dark'],
            ['title' => 'Job Clicks', 'value' => $totalJobClicks, 'bg' => 'bg-light text-dark']
        ];
        foreach ($engagementStats as $stat): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card <?= $stat['bg'] ?> shadow-sm h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h6 class="card-title"><?= $stat['title'] ?></h6>
                        <p class="card-text display-6"><?= $stat['value'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Charts Section -->
    <div class="row mt-5">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">User Distribution</div>
                <div class="card-body">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">Content Overview</div>
                <div class="card-body">
                    <canvas id="contentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Entries -->
    <h2 class="mt-5 mb-3 text-center">Latest Entries</h2>
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">Latest Blog Posts</div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($latestBlogs as $blog): ?>
                        <li class="list-group-item">
                            <a href="/admin/blogs/detail.php?id=<?= $blog['id'] ?>"><?= htmlspecialchars($blog['title']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">Latest News</div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($latestNews as $news): ?>
                        <li class="list-group-item">
                            <a href="/admin/news/detail.php?id=<?= $news['id'] ?>"><?= htmlspecialchars($news['name']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header">Latest Job Posts</div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($latestJobs as $job): ?>
                        <li class="list-group-item">
                            <a href="/admin/jobs/detail.php?id=<?= $job['id'] ?>"><?= htmlspecialchars($job['title']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Charts Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var userCtx = document.getElementById('userChart').getContext('2d');
    new Chart(userCtx, {
        type: 'doughnut',
        data: {
            labels: ['Users', 'Admins'],
            datasets: [{
                data: [<?= $totalUsers - 10 ?>, 10],
                backgroundColor: ['#007bff', '#dc3545']
            }]
        }
    });

    var contentCtx = document.getElementById('contentChart').getContext('2d');
    new Chart(contentCtx, {
        type: 'bar',
        data: {
            labels: ['Blogs', 'News', 'Jobs'],
            datasets: [{
                label: 'Content Overview',
                data: [<?= $totalBlogs ?>, <?= $totalNews ?>, <?= $totalJobs ?>],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545']
            }]
        }
    });
});
</script>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
