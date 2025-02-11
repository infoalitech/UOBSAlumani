<?php
require_once '../config/database.php';
require_once '../models/Job.php';

$database = new Database();
$db = $database->getConnection();

$job = new Job($db);
$stmt = $job->read();
$num = $stmt->rowCount();

include '../views/header.php';
?>

<div class="container">
    <h1>Job Postings</h1>
    <a href="create_job.php" class="btn btn-primary">Create New Job</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Organization</th>
                <th>Open Date</th>
                <th>Last Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    echo "<tr>
                            <td>{$id}</td>
                            <td>{$title}</td>
                            <td>{$organization}</td>
                            <td>{$open_date}</td>
                            <td>{$last_date}</td>
                            <td>
                                <a href='job_detail.php?id={$id}' class='btn btn-info'>View</a>
                                <a href='edit_job.php?id={$id}' class='btn btn-warning'>Edit</a>
                                <a href='delete_job.php?id={$id}' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No job postings found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../views/footer.php'; ?>