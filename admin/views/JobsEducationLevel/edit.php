<?php
// filepath: /Applications/AMPPS/www/UOBSAlumani/php-crud-app/admin/views/jobs/edit.php
?>
<!DOCTYPE html>
<html>
head>
    <title>Edit Job</title>
</head>
<body>
    <h1>Edit Job</h1>
    <form method="POST" action="edit.php?id=<?php echo $job['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $job['title']; ?>" required>
        <br>
        <label for="desc">Description:</label>
        <textarea id="desc" name="desc" required><?php echo $job['desc']; ?></textarea>
        <br>
        <label for="requirement">Requirement:</label>
        <textarea id="requirement" name="requirement" required><?php echo $job['requirement']; ?></textarea>
        <br>
        <label for="organization">Organization:</label>
        <input type="text" id="organization" name="organization" value="<?php echo $job['organization']; ?>" required>
        <br>
        <label for="post_link">Post Link:</label>
        <input type="text" id="post_link" name="post_link" value="<?php echo $job['post_link']; ?>" required>
        <br>
        <label for="apply_link">Apply Link:</label>
        <input type="text" id="apply_link"<?php
// filepath: /Applications/AMPPS/www/UOBSAlumani/php-crud-app/admin/views/jobs/edit.php
?>
<!DOCTYPE html>
<html>
head>
    <title>Edit Job</title>
</head>
<body>
    <h1>Edit Job</h1>
    <form method="POST" action="edit.php?id=<?php echo $job['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $job['title']; ?>" required>
        <br>
        <label for="desc">Description:</label>
        <textarea id="desc" name="desc" required><?php echo $job['desc']; ?></textarea>
        <br>
        <label for="requirement">Requirement:</label>
        <textarea id="requirement" name="requirement" required><?php echo $job['requirement']; ?></textarea>
        <br>
        <label for="organization">Organization:</label>
        <input type="text" id="organization" name="organization" value="<?php echo $job['organization']; ?>" required>
        <br>
        <label for="post_link">Post Link:</label>
        <input type="text" id="post_link" name="post_link" value="<?php echo $job['post_link']; ?>" required>
        <br>
        <label for="apply_link">Apply Link:</label>
        <input type="text" id="apply_link"