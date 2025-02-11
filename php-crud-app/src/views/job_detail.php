<?php
require_once '../config/database.php';

$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($job_id > 0) {
    $query = "SELECT * FROM job_posts WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $job = $result->fetch_assoc();
} else {
    header("Location: jobs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($job['title']); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($job['title']); ?></h1>
        <p><strong>Organization:</strong> <?php echo htmlspecialchars($job['organization']); ?></p>
        <p><strong>Open Date:</strong> <?php echo htmlspecialchars($job['open_date']); ?></p>
        <p><strong>Last Date:</strong> <?php echo htmlspecialchars($job['last_date']); ?></p>
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
        <p><strong>Requirements:</strong> <?php echo nl2br(htmlspecialchars($job['requirement'])); ?></p>
        <p><strong>Country:</strong> <?php echo htmlspecialchars($job['country']); ?></p>
        <p><a href="<?php echo htmlspecialchars($job['apply_link']); ?>" target="_blank">Apply Here</a></p>
        <a href="jobs.php">Back to Job Listings</a>
    </div>
</body>
</html>