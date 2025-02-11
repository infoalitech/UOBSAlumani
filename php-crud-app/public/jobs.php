<?php
session_start();
require_once '../src/config/database.php';
require_once '../src/models/Job.php';

$jobModel = new Job($db);
$jobs = $jobModel->getAllJobs();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Postings</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Job Postings</h1>
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
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Available Jobs</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Organization</th>
                    <th>Open Date</th>
                    <th>Last Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jobs as $job): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($job['title']); ?></td>
                        <td><?php echo htmlspecialchars($job['organization']); ?></td>
                        <td><?php echo htmlspecialchars($job['open_date']); ?></td>
                        <td><?php echo htmlspecialchars($job['last_date']); ?></td>
                        <td><a href="job_detail.php?id=<?php echo $job['id']; ?>">View Details</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Company. All rights reserved.</p>
    </footer>
</body>
</html>