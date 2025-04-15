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
            <div class="col-md-10">
                <form method="POST" action="<?= $basePath ?>/update_profile_handler" enctype="multipart/form-data">
                    <input type="hidden" name="profile_id" value="<?= $profile['id'] ?>">
                    <input type="hidden" name="old_profile_picture" value="<?= htmlspecialchars($profile['profile_picture'] ?? '') ?>">

                    <!-- Personal Information -->
                    <h3 class="mt-4 mb-2">Personal Information</h3>
                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" name="full_name" value="<?= htmlspecialchars($profile['full_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Father's Name:</label>
                            <input type="text" class="form-control" name="father_name" value="<?= htmlspecialchars($profile['father_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>CNIC:</label>
                            <input type="text" class="form-control" name="cnic" value="<?= htmlspecialchars($profile['cnic'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Registration No:</label>
                            <input type="text" class="form-control" name="reg_no" value="<?= htmlspecialchars($profile['reg_no'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($profile['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone:</label>
                            <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($profile['phone'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <h3 class="mt-4 mb-2">Academic Information</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Graduation Year:</label>
                            <input type="number" class="form-control" name="graduation_year" value="<?= htmlspecialchars($profile['graduation_year'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Department:</label>
                            <input type="text" class="form-control" name="department" value="<?= htmlspecialchars($profile['department'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Program:</label>
                            <input type="text" class="form-control" name="program" value="<?= htmlspecialchars($profile['program'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Education Level:</label>
                            <select class="form-control" name="education_level_id">
                                <option value="">-- Select --</option>
                                <option value="1" <?= ($profile['education_level_id'] == 1) ? 'selected' : '' ?>>Bachelor</option>
                                <option value="2" <?= ($profile['education_level_id'] == 2) ? 'selected' : '' ?>>Master</option>
                                <option value="3" <?= ($profile['education_level_id'] == 3) ? 'selected' : '' ?>>PhD</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Additional Qualifications:</label>
                            <textarea class="form-control" name="additional_qualifications"><?= htmlspecialchars($profile['additional_qualifications'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <h3 class="mt-4 mb-2">Professional Information</h3>
                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Current City:</label>
                            <input type="text" class="form-control" name="current_city" value="<?= htmlspecialchars($profile['current_city'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Current Position:</label>
                            <input type="text" class="form-control" name="current_position" value="<?= htmlspecialchars($profile['current_position'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Company Name:</label>
                            <input type="text" class="form-control" name="company_name" value="<?= htmlspecialchars($profile['company_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Job Type:</label>
                            <select class="form-control" name="job_type">
                                <option value="">-- Select --</option>
                                <option value="full-time" <?= ($profile['job_type'] == 'full-time') ? 'selected' : '' ?>>Full-time</option>
                                <option value="part-time" <?= ($profile['job_type'] == 'part-time') ? 'selected' : '' ?>>Part-time</option>
                                <option value="freelance" <?= ($profile['job_type'] == 'freelance') ? 'selected' : '' ?>>Freelance</option>
                                <option value="unemployed" <?= ($profile['job_type'] == 'unemployed') ? 'selected' : '' ?>>Unemployed</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Years of Experience:</label>
                            <input type="number" class="form-control" name="experience_years" value="<?= htmlspecialchars($profile['experience_years'] ?? '') ?>" min="0" max="50">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>LinkedIn URL:</label>
                            <input type="url" class="form-control" name="linkedin_url" value="<?= htmlspecialchars($profile['linkedin_url'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Portfolio URL:</label>
                            <input type="url" class="form-control" name="portfolio_url" value="<?= htmlspecialchars($profile['portfolio_url'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Preferences -->
                    <h3 class="mt-4 mb-2">Preferences</h3>
                    <hr>

                    <div class="row">
                        <div class="col-md-4 mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="is_profile_public" value="1" <?= $profile['is_profile_public'] ? 'checked' : '' ?>>
                            <label class="form-check-label">Make profile public</label>
                        </div>
                        <div class="col-md-4 mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="show_contact_info" value="1" <?= $profile['show_contact_info'] ? 'checked' : '' ?>>
                            <label class="form-check-label">Show contact info</label>
                        </div>
                        <div class="col-md-4 mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="show_position" value="1" <?= $profile['show_position'] ? 'checked' : '' ?>>
                            <label class="form-check-label">Show current position</label>
                        </div>
                    </div>

                    <!-- Profile Picture -->
                    <h3 class="mt-4 mb-2">Profile Picture</h3>
                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="file" class="form-control" name="profile_picture">
                            <?php if (!empty($profile['profile_picture'])): ?>
                                <img src="/uploads/<?= htmlspecialchars($profile['profile_picture'] ?? '') ?>" alt="Current Image" class="mt-2 img-thumbnail" style="max-height: 120px;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-success">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'snippets/footer.php'; ?>
