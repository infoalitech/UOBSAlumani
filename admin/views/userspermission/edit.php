<?php 
require_once '../layouts/header.php'; // Include the header
require_once '../../config/database.php'; // Database connection

// Validate and fetch the user data
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid User ID");
}

$id = intval($_GET['id']); // Ensure it's an integer

// Fetch user data securely using a prepared statement
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_OBJ);

if (!$user) {
    die("User not found.");
}
?>

<h1>Edit User</h1>
<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user->id); ?>">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user->name); ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user->email); ?>" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn">Update User</button>
        <a href="index.php" class="btn cancel">Cancel</a>
    </div>
</form>

<?php require_once '../layouts/footer.php'; // Include the footer ?>
