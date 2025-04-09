<?php
$title = 'Register';
include 'snippets/header.php';
?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1>Register</h1>
        <p>Join the UOBS Alumni Network and stay connected.</p>

        <?php
            // Display errors if any
            if (!empty($_SESSION['form_errors'])) {
                echo '<div class="alert alert-danger">';
                foreach ($_SESSION['form_errors'] as $error) {
                    echo "<p>" . htmlspecialchars($error) . "</p>";
                }
                echo '</div>';
                unset($_SESSION['form_errors']); // Clear after showing
            }
        ?>
    </div>
</div><!-- End Page Title -->

<!-- Registration Section -->
<section id="register" class="features section">
  <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="<?= $basePath ?>/register_handler">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Full Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="graduation_year">Graduation Year:</label>
                        <input type="number" class="form-control" id="graduation_year" name="graduation_year" min="2000" max="<?= date('Y') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="department">Department:</label>
                        <input type="text" class="form-control" id="department" name="department">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="program">Program:</label>
                        <input type="text" class="form-control" id="program" name="program">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>

                    <div class="col-12 mb-3">
                        <label>
                            <input type="checkbox" name="is_alumni" value="1" checked>
                            I confirm that I am an alumni of UOBS.
                        </label>
                    </div>
                    <?php
                    $captchaA = rand(1, 9);
                    $captchaB = rand(1, 9);
                    $_SESSION['captcha_answer'] = $captchaA + $captchaB;
                    ?>
                    <div class="col-12 mb-3">
                        <label for="captcha">What is <?= $captchaA ?> + <?= $captchaB ?>?</label>
                        <input type="number" class="form-control" id="captcha" name="captcha" required>
                    </div>


                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>

                    <div class="form-group text-center">
                    <p class="mt-3 mb-0">Do you have an account? 
                        <a href="<?= $basePath ?>/login" class="text-primary">Login here</a>.
                    </p>
                </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        let errors = [];

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const graduationYear = document.getElementById("graduation_year").value.trim();
        const department = document.getElementById("department").value.trim();
        const program = document.getElementById("program").value.trim();
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;
        const captcha = document.getElementById("captcha").value.trim();

        // Required fields
        if (!name || !email || !graduationYear || !password || !confirmPassword || !captcha) {
            errors.push("Please fill in all required fields.");
        }

        // Email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) {
            errors.push("Please enter a valid email address.");
        }

        // Graduation year range
        const currentYear = new Date().getFullYear();
        if (graduationYear < 2000 || graduationYear > currentYear) {
            errors.push("Graduation year must be between 2000 and " + currentYear + ".");
        }

        // Password match
        if (password !== confirmPassword) {
            errors.push("Passwords do not match.");
        }

        // CAPTCHA must be a number
        if (isNaN(captcha)) {
            errors.push("CAPTCHA must be a number.");
        }

        // Show alert and prevent form submission
        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\n"));
        }
    });
});
</script>

<?php include 'snippets/footer.php'; ?>
