<?php
session_start();
$title = '404 Not Found';
include 'snippets/header.php';
include 'snippets/navigation.php';
?>
<div class="container">
    <h1 class="display-4">404 Not Found</h1>
    <p class="lead">The page you are looking for does not exist.</p>
    <a href="/UOBSAlumani/php-crud-app/public/index.php" class="btn btn-primary">Go to Home</a>
</div>
<?php include 'snippets/footer.php'; ?>