<?php
$title = 'UOBS Alumni';
include 'snippets/header.php';
?>

<div class="container mt-4">
    <!-- Cover Image -->
    <div class="jumbotron text-center text-white p-5 rounded" style="background: url('https://uobs.edu.pk/images/main/sarfaranga.jpg') no-repeat center center; background-size: cover;">
        <h1>Welcome to UOBS Alumni Portal</h1>
        <p>Stay connected with fellow alumni, explore job opportunities, and read the latest blogs and news.</p>
    </div>
    
    <div class="row mt-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Latest Blogs -->
            <h2 class="mt-3">Latest Blogs</h2>
            <div class="row">
                <?php foreach ($latestBlogs as $blog): ?>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <img src="<?= $basePath ?>/<?= $blog['cover'] ?>" class="card-img-top" alt="<?= htmlspecialchars($blog['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($blog['title']) ?></h5>
                                <a href="blogDetail.php?id=<?= $blog['id'] ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Job Categories -->
            <h2 class="mt-5">Job Categories</h2>
            <div class="row">
                <?php foreach ($jobCategories as $category): ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($category['name']) ?></h5>
                                <a href="jobs.php?category=<?= $category['id'] ?>" class="btn btn-info">View Jobs</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Latest Job Posts -->
            <h3 class="mt-3">Latest Jobs</h3>
            <ul class="list-group">
                <?php foreach ($latestJobs as $job): ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($job['title']) ?></strong><br>
                        <small><?= htmlspecialchars($job['company']) ?> - <?= htmlspecialchars($job['location']) ?></small><br>
                        <a href="jobDetail.php?id=<?= $job['id'] ?>" class="btn btn-sm btn-success mt-2">View Details</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <!-- Latest News -->
            <h3 class="mt-4">Latest News</h3>
            <ul class="list-group">
                <?php foreach ($latestNews as $news): ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($news['title']) ?></strong><br>
                        <a href="newsDetail.php?id=<?= $news['id'] ?>" class="btn btn-sm btn-warning mt-2">Read More</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php include 'snippets/footer.php'; ?>
