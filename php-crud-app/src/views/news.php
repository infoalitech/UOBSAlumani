<?php
require_once '../config/database.php';

class NewsController {
    private $db;
    private $newsModel;

    public function __construct() {
        $this->db = new Database();
        $this->newsModel = new News($this->db->getConnection());
    }

    public function index() {
        $newsArticles = $this->newsModel->getAllNews();
        include '../views/news.php';
    }
}

$controller = new NewsController();
$controller->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>News Articles</h1>
    </header>
    <main>
        <section>
            <?php if (!empty($newsArticles)): ?>
                <ul>
                    <?php foreach ($newsArticles as $news): ?>
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
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Company</p>
    </footer>
</body>
</html>