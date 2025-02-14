<?php
// filepath: /Applications/AMPPS/www/UOBSAlumani/php-crud-app/admin/views/jobs/create.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Job</title>
</head>
<body>
    <h1>Create Job</h1>
    <form method="POST" action="create.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="desc">Description:</label>
        <textarea id="desc" name="desc" required></textarea>
        <br>
        <label for="requirement">Requirement:</label>
        <textarea id="requirement" name="requirement" required></textarea>
        <br>
        <label for="organization">Organization:</label>
        <input type="text" id="organization" name="organization" required>
        <br>
        <label for="post_link">Post Link:</label>
        <input type="text" id="post_link" name="post_link" required>
        <br>
        <label for="apply_link">Apply Link:</label>
        <input type="text" id="apply_link" name="apply_link" required>
        <br>
        <label for="type_id">Type:</label>
        <select id="type_id" name="type_id" required>
            <?php foreach ($types as $type): ?>
                <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="field_id">Field:</label>
        <select id="field_id" name="field_id" required>
            <?php foreach ($fields as $field): ?>
                <option value="<?php echo $field['id']; ?>"><?php echo $field['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="level_id">Education Level:</label>
        <select id="level_id" name="level_id" required>
            <?php foreach ($levels as $level): ?>
                <option value="<?php echo $level['id']; ?>"><?php echo $level['level']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required>
        <br>
        <label for="open_date">Open Date:</label>
        <input type="date" id="open_date" name="open_date" required>
        <br>
        <label for="last_date">Last Date:</label>
        <input type="date" id="last_date" name="last_date" required>
        <br>
        <label for="inserted_by">Inserted By:</label>
        <input type="text" id="inserted_by" name="inserted_by" required>
        <br>
        <button type="submit">Create</button>
    </form>
</body>
</html>