<?php
session_start();
require_once '../src/config/database.php';
require_once '../src/controllers/NewsController.php';

$newsController = new NewsController($db);
$newsList = $newsController->getAllNews();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>News Articles</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="blogs.php">Blogs</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php if (!empty($newsList)): ?>
            <ul>
                <?php foreach ($newsList as $news): ?>
                    <li>
                        <h2><?php echo htmlspecialchars($news['name']); ?></h2>
                        <p><?php echo htmlspecialchars($news['description']); ?></p>
                        <p>Status: <?php echo htmlspecialchars($news['status']); ?></p>
                        <p>Date: <?php echo htmlspecialchars($news['date']); ?></p>
                        <a href="news_detail.php?id=<?php echo $news['id']; ?>">Read more</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No news articles found.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Company Name. All rights reserved.</p>
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>