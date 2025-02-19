<?php
$title = 'Job Opportunities';
include 'snippets/header.php';
?>
<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
    <h1>Explore Opportunities</h1>
    <p>Discover the latest updates, blogs, and job openings from the UOBS Alumni Network.</p>
    </div>
</div><!-- End Page Title -->

<!-- Features Section -->
<section id="features" class="features section">
  <div class="container mt-4">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Job Listings</h2>
            <p>Find the latest job opportunities from our network of employers.</p>
        </div>
        
        <!-- Filter Button for Mobile -->
        <div class="d-block d-md-none text-center mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">Filter Jobs</button>
        </div>
        
        <div class="col-md-3 d-none d-md-block">
            <div id="filters" class="row">
                <div class="mb-3">
                    <input type="text" id="search" class="form-control" placeholder="Search by job title, description, organization...">
                </div>

                <div class="mb-3">
                    <h6>Job Type</h6>
                    <?php foreach ($jobtypes as $jobtype): ?>
                        <div class="form-check">
                            <input class="form-check-input job-type" type="checkbox" value="<?= $jobtype['id'] ?>">
                            <label class="form-check-label"> <?= htmlspecialchars($jobtype['name']) ?> </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-3">
                    <h6>Job Category</h6>
                    <?php foreach ($jobCategories as $category): ?>
                        <div class="form-check">
                            <input class="form-check-input job-category" type="checkbox" value="<?= $category['id'] ?>">
                            <label class="form-check-label"> <?= htmlspecialchars($category['name']) ?> </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-3">
                    <h6>Education Level</h6>
                    <?php foreach ($jobEducationLevels as $level): ?>
                        <div class="form-check">
                            <input class="form-check-input job-level" type="checkbox" value="<?= $level['id'] ?>">
                            <label class="form-check-label"> <?= htmlspecialchars($level['level']) ?> </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mb-3">
                    <h6>Fields</h6>
                    <?php foreach ($jobFields as $jobField): ?>
                        <div class="form-check">
                            <input class="form-check-input job-fields" type="checkbox" value="<?= $jobField['id'] ?>">
                            <label class="form-check-label"> <?= htmlspecialchars($jobField['name']) ?> </label>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="container mt-4">
                <div class="row" id="job-results"></div>
            </div>
        </div>
    </div>
  </div>
</section><!-- /Features Section -->

<!-- Mobile Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Jobs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="mobile-filters">
                    <div class="mb-3">
                        <input type="text" id="mobile-search" class="form-control" placeholder="Search by job title, description, organization...">
                    </div>
                    
                    <div class="mb-3">
                        <h6>Job Type</h6>
                        <?php foreach ($jobtypes as $jobtype): ?>
                            <div class="form-check">
                                <input class="form-check-input mobile-job-type" type="checkbox" value="<?= $jobtype['id'] ?>">
                                <label class="form-check-label"> <?= htmlspecialchars($jobtype['name']) ?> </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mb-3">
                        <h6>Job Category</h6>
                        <?php foreach ($jobCategories as $category): ?>
                            <div class="form-check">
                                <input class="form-check-input mobile-job-category" type="checkbox" value="<?= $category['id'] ?>">
                                <label class="form-check-label"> <?= htmlspecialchars($category['name']) ?> </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mb-3">
                        <h6>Education Level</h6>
                        <?php foreach ($jobEducationLevels as $level): ?>
                            <div class="form-check">
                                <input class="form-check-input  mobile-job-level" type="checkbox" value="<?= $level['id'] ?>">
                                <label class="form-check-label"> <?= htmlspecialchars($level['level']) ?> </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mb-3">
                        <h6>Fields</h6>
                        <?php foreach ($jobFields as $jobField): ?>
                            <div class="form-check">
                                <input class="form-check-input  mobile-job-fields" type="checkbox" value="<?= $jobField['id'] ?>">
                                <label class="form-check-label"> <?= htmlspecialchars($jobField['name']) ?> </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="applyMobileFilters()">Apply Filters</button>
            </div>
        </div>
    </div>
</div>

<?php include 'snippets/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    function fetchJobs() {
        let formData = new FormData();
        let selectedTypes = Array.from(document.querySelectorAll(".job-type:checked, .mobile-job-type:checked"))
            .map(checkbox => checkbox.value);
        let selectedCategories = Array.from(document.querySelectorAll(".job-category:checked, .mobile-job-category:checked"))
            .map(checkbox => checkbox.value);
        let selectedJoblevels = Array.from(document.querySelectorAll(".job-level:checked, .mobile-job-level:checked"))
            .map(checkbox => checkbox.value);
        let selectedJobFields = Array.from(document.querySelectorAll(".job-fields:checked, .mobile-job-fields:checked"))
            .map(checkbox => checkbox.value);

            
        formData.append("type", selectedTypes.join(","));
        formData.append("category", selectedCategories.join(","));
        formData.append("selectedJoblevels", selectedJoblevels.join(","));
        formData.append("selectedJobFields", selectedJobFields.join(","));
        formData.append("search", document.getElementById("search").value || document.getElementById("mobile-search").value);
        fetch("fetchFilteredJobs", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("job-results").innerHTML = data.jobs.length ? data.jobs.map(job => `
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <h5 class="card-title">${job.title}</h5>
                        <p>${job.organization}</p>
                        <a href="jobDetail.php?id=${job.id}" class="btn btn-primary">View Details</a>
                    </div>
                </div>`).join('') : '<p class="alert alert-warning text-center">No jobs found.</p>';
        });
    }
    document.querySelectorAll(".job-type, .job-category, .job-level, .job-field").forEach(el => el.addEventListener("change", fetchJobs));
    document.getElementById("search").addEventListener("input", fetchJobs);
    fetchJobs();
});
</script>
