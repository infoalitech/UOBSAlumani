<?php
require_once '../config/database.php';
require_once '../controllers/BlogController.php';

$blogController = new BlogController();
$blogs = $blogController->getAllBlogs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Blogs</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="blogs.php">Blogs</a>
            <a href="news.php">News</a>
            <a href="jobs.php">Jobs</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <section>
            <?php if (empty($blogs)): ?>
                <p>No blogs available.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($blogs as $blog): ?>
                        <li>
                            <h2><?php echo htmlspecialchars($blog['title']); ?></h2>
                            <p><?php echo htmlspecialchars($blog['description']); ?></p>
                            <a href="blog_detail.php?id=<?php echo $blog['id']; ?>">Read more</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Company</p>
    </footer>
</body>
</html>