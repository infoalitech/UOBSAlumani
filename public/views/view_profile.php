<?php
$title = 'My Profile';
include 'snippets/header.php';
?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1>My Profile</h1>
        <p>View your registered alumni profile details.</p>
    </div>
</div>

<!-- Profile Section -->
<section class="features section">
    <div class="container mt-4">
        <?php if (!empty($profile)): ?>
            <div class="     p-4 shadow-sm">
                <div class="row">
                    <!-- Profile Picture -->
                    <div class="col-md-4 text-center mb-3 mb-md-0">
                        <?php if (!empty($profile['profile_picture'])): ?>
                            <img src="<?= $basePath ?>/uploads/<?= htmlspecialchars($profile['profile_picture']) ?>" alt="Profile Picture" class="img-fluid rounded" style="max-height: 250px;">
                        <?php else: ?>
                            <img src="<?= $basePath ?>/assets/images/default-avatar.png" alt="Default" class="img-fluid rounded" style="max-height: 250px;">
                        <?php endif; ?>

                        <?php if (!empty($profile['linkedin_url'])): ?>
                            <p class="mt-3">
                                <a href="<?= htmlspecialchars($profile['linkedin_url']) ?>" target="_blank" class="btn btn-outline-primary btn-sm">View LinkedIn</a>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Profile Details -->
                    <div class="col-md-8">
                        <h4><?= htmlspecialchars($profile['current_position'] ?: 'Alumni') ?></h4>
                        <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['name'] ?? '') ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['username'] ?? '') ?></p>
                        <p><strong>Graduation Year:</strong> <?= htmlspecialchars($profile['graduation_year']) ?></p>
                        <p><strong>Department:</strong> <?= htmlspecialchars($profile['department']) ?></p>
                        <p><strong>Program:</strong> <?= htmlspecialchars($profile['program']) ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($profile['phone']) ?></p>
                        <p><strong>City:</strong> <?= htmlspecialchars($profile['current_city']) ?></p>
                        <p><strong>Company:</strong> <?= htmlspecialchars($profile['company_name']) ?></p>

                        <div class="mt-3">
                            <a href="<?= $basePath ?>/profile/update" class="btn btn-success btn-sm">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">Profile not found.</div>
        <?php endif; ?>
    </div>
</section>

<?php include 'snippets/footer.php'; ?>
