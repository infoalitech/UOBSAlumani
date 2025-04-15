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
            <div class="row">
                <!-- Profile Image + Personal Info Card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="accents">
                            <div class="acc-card"></div><div class="acc-card"></div><div class="acc-card"></div>
                            <div class="light"></div><div class="light sm"></div>
                            <div class="top-light"></div>
                        </div>
                        <div class="">
                        <?php if (!empty($profile['profile_picture'])): ?>
                                <img src="<?= $basePath ?>/uploads/<?= htmlspecialchars($profile['profile_picture'] ?? '') ?>" alt="Profile Picture" class="card-img-top" >
                            <?php else: ?>
                                <img src="<?= $basePath ?>/assets/images/default-avatar.png" alt="Default" class="card-img-top" >
                            <?php endif; ?>


                            <h5 class="card-title"><?= htmlspecialchars($profile['full_name'] ?? 'Alumni') ?></h5>
                            <p class="card-text"><?= htmlspecialchars($profile['current_position'] ?? '') ?></p>


                            <p><strong>Father's Name:</strong> <?= htmlspecialchars($profile['father_name'] ?? '') ?></p>
                            <p><strong>CNIC:</strong> <?= htmlspecialchars($profile['cnic'] ?? '') ?></p>
                            <p><strong>Registration No:</strong> <?= htmlspecialchars($profile['reg_no'] ?? '') ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($profile['email'] ?? '') ?></p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($profile['phone'] ?? '') ?></p>

                            <a href="<?= $basePath ?>/profile/update" class="btn btn-success  btn-sm">Edit Profile</a>
                            <?php if (!empty($profile['linkedin_url'])): ?>
                                <a href="<?= htmlspecialchars($profile['linkedin_url']) ?>" target="_blank" class="btn btn-primary btn-sm">LinkedIn</a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <!-- Other Details -->
                <div class="col-md-8">

                    <!-- Academic Information -->
                    <h5 class="mb-2">Academic Information</h5>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Graduation Year</th>
                                <td><?= htmlspecialchars($profile['graduation_year'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td><?= htmlspecialchars($profile['department'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <th>Program</th>
                                <td><?= htmlspecialchars($profile['program'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <th>Education Level</th>
                                <td>
                                    <?php
                                        $eduLevels = [1 => "Bachelor", 2 => "Master", 3 => "PhD"];
                                        echo htmlspecialchars($eduLevels[$profile['education_level_id']] ?? 'N/A');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Additional Qualifications</th>
                                <td><?= htmlspecialchars($profile['additional_qualifications'] ?? '') ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Professional Information -->
                    <h5 class="mt-4 mb-2">Professional Information</h5>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Current City</th>
                                <td><?= htmlspecialchars($profile['current_city'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <th>Current Position</th>
                                <td><?= htmlspecialchars($profile['current_position'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <th>Company Name</th>
                                <td><?= htmlspecialchars($profile['company_name'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <th>Job Type</th>
                                <td><?= htmlspecialchars($profile['job_type'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <th>Experience (Years)</th>
                                <td><?= htmlspecialchars($profile['experience_years'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <th>Portfolio</th>
                                <td>
                                    <?php if (!empty($profile['portfolio_url'])): ?>
                                        <a href="<?= htmlspecialchars($profile['portfolio_url']) ?>" target="_blank"><?= htmlspecialchars($profile['portfolio_url']) ?></a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Preferences -->
                    <h5 class="mt-4 mb-2">Visibility Preferences</h5>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Public Profile</th>
                                <td><?= ($profile['is_profile_public'] ?? 0) ? 'Yes' : 'No' ?></td>
                            </tr>
                            <tr>
                                <th>Show Contact Info</th>
                                <td><?= ($profile['show_contact_info'] ?? 0) ? 'Yes' : 'No' ?></td>
                            </tr>
                            <tr>
                                <th>Show Current Position</th>
                                <td><?= ($profile['show_position'] ?? 0) ? 'Yes' : 'No' ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Edit Button -->
                    <div class="text-end mt-4">
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">Profile not found.</div>
        <?php endif; ?>
    </div>
</section>

<?php include 'snippets/footer.php'; ?>
