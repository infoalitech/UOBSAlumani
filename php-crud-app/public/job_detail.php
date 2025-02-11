<?php
require_once '../src/config/database.php';
require_once '../src/models/Job.php';

$database = new Database();
$db = $database->getConnection();

$job = new Job($db);

if (isset($_GET['id'])) {
    $job->id = $_GET['id'];
    $jobDetails = $job->getJobDetails();

    if (!$jobDetails) {
        echo "Job not found.";
        exit;
    }
} else {
    echo "No job ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Detail</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($jobDetails['title']); ?></h1>
        <p><strong>Organization:</strong> <?php echo htmlspecialchars($jobDetails['organization']); ?></p>
        <p><strong>Open Date:</strong> <?php echo htmlspecialchars($jobDetails['open_date']); ?></p>
        <p><strong>Last Date:</strong> <?php echo htmlspecialchars($jobDetails['last_date']); ?></p>
        <p><strong>Description:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($jobDetails['description'])); ?></p>
        <p><strong>Requirements:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($jobDetails['requirement'])); ?></p>
        <p><strong>Job Type:</strong> <?php echo htmlspecialchars($jobDetails['type_name']); ?></p>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($jobDetails['category_name']); ?></p>
        <p><strong>Field:</strong> <?php echo htmlspecialchars($jobDetails['field_name']); ?></p>
        <p><strong>Education Level:</strong> <?php echo htmlspecialchars($jobDetails['level_name']); ?></p>
        <p><strong>Country:</strong> <?php echo htmlspecialchars($jobDetails['country']); ?></p>
        <a href="jobs.php">Back to Job Listings</a>
    </div>
</body>
</html>