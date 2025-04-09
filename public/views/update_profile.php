<?php
$title = 'Update Profile';
include 'snippets/header.php';
?>

<div class="page-title light-background">
    <div class="container">
        <h1>Update Profile</h1>
        <p>Keep your alumni information up to date.</p>

        <?php if (!empty($_SESSION['form_errors'])): ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION['form_errors'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; unset($_SESSION['form_errors']); ?>
            </div>
        <?php elseif (!empty($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<section class="features section">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="<?= $basePath ?>/update_profile_handler" enctype="multipart/form-data">
                    <input type="hidden" name="profile_id" value="<?= $profile['id'] ?>">
                    <input type="hidden" name="old_profile_picture" value="<?= htmlspecialchars($profile['profile_picture']) ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Graduation Year:</label>
                            <input type="number" class="form-control" name="graduation_year" value="<?= htmlspecialchars($profile['graduation_year']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone:</label>
                            <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($profile['phone']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Department:</label>
                            <input type="text" class="form-control" name="department" value="<?= htmlspecialchars($profile['department']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Program:</label>
                            <input type="text" class="form-control" name="program" value="<?= htmlspecialchars($profile['program']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Current City:</label>
                            <input type="text" class="form-control" name="current_city" value="<?= htmlspecialchars($profile['current_city']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Current Position:</label>
                            <input type="text" class="form-control" name="current_position" value="<?= htmlspecialchars($profile['current_position']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Company Name:</label>
                            <input type="text" class="form-control" name="company_name" value="<?= htmlspecialchars($profile['company_name']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>LinkedIn URL:</label>
                            <input type="url" class="form-control" name="linkedin_url" value="<?= htmlspecialchars($profile['linkedin_url']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Profile Picture:</label>
                            <input type="file" class="form-control" name="profile_picture">
                            <?php if (!empty($profile['profile_picture'])): ?>
                                <img src="/uploads/<?= htmlspecialchars($profile['profile_picture']) ?>" alt="Current Image" class="mt-2 img-thumbnail" style="max-height: 120px;">
                            <?php endif; ?>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'snippets/footer.php'; ?>
