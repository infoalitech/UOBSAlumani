<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">User Details</h1>
        <a href="<?= $basePath ?>/admin/alumni" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-lg p-4">
        <!-- User Name & Email -->
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary"><?= htmlspecialchars($user['name']); ?></h2>
            <p class="text-muted"><?= htmlspecialchars($user['email']); ?></p>
        </div>

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

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <a href="<?= $basePath ?>/admin/alumni/edit?id=<?= $user['id']; ?>" class="btn btn-warning">Edit User</a>
            <a href="<?= $basePath ?>/admin/alumni/delete?id=<?= $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
