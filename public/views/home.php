<?php
session_start();
$title = 'Home';
include 'snippets/header.php';
include 'snippets/navigation.php';
?>
<div class="jumbotron">
    <h1 class="display-4">Welcome to UOBS Alumni</h1>
    <p class="lead">This is the home page of the UOBS Alumni CRUD application.</p>
</div>
<?php include 'snippets/footer.php'; ?>