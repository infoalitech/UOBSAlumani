<?php
session_start();
require_once '../src/controllers/HomeController.php';

$homeController = new HomeController();
$news = $homeController->getLatestNews();
$blogs = $homeController->getLatestBlogs();
$jobs = $homeController->getLatestJobs();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Home - PHP CRUD App</title>
</head>
<body>
    <header>
        <h1>Welcome to the PHP CRUD Application</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="blogs.php">Blogs</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Latest News</h2>
            <ul>
                <?php foreach ($news as $article): ?>
                    <li><a href="news.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section>
            <h2>Latest Blogs</h2>
            <ul>
                <?php foreach ($blogs as $blog): ?>
                    <li><a href="blogs.php?id=<?= $blog['id'] ?>"><?= htmlspecialchars($blog['title']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section>
            <h2>Latest Job Postings</h2>
            <ul>
                <?php foreach ($jobs as $job): ?>
                    <li><a href="job_detail.php?id=<?= $job['id'] ?>"><?= htmlspecialchars($job['title']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> PHP CRUD Application</p>
    </footer>

    <script src="js/scripts.js"></script>
</body>
</html>