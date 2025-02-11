<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - PHP CRUD App</title>
    <link rel="stylesheet" href="css/styles.css">
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
        <h2>Latest Updates</h2>
        <p>Stay tuned for the latest news, blogs, and job postings!</p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> PHP CRUD App. All rights reserved.</p>
    </footer>

    <script src="js/scripts.js"></script>
</body>
</html>