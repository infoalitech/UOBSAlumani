<?php
namespace Admin\Controllers;

use Admin\Models\User;
use Admin\Models\AlumniProfile;

class AlumniRegistrationController {
    private $db;
    private $userModel;
    private $profileModel;

    public function __construct() {
        $this->db = require __DIR__ . '/../../config/database.php';
        $this->userModel = new User($this->db);
        $this->profileModel = new AlumniProfile($this->db);
    }

    public function handleRegister($basePath) {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $errors[] = "Method Not Allowed.";
        }

        $name = trim($_POST['name'] ?? '');
        $fatherName = trim($_POST['father_name'] ?? '');
        $regNo = trim($_POST['reg_no'] ?? '');
        $cnic = trim($_POST['cnic'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $captcha = $_POST['captcha'] ?? '';
        $isAlumni = isset($_POST['is_alumni']) ? 1 : 0;

        $_SESSION['old_input'] = $_POST;

        // Validation
        if (!$name || !$email || !$password || !$confirmPassword || !$captcha || !$regNo || !$cnic || !$fatherName) {
            $errors[] = "All required fields must be filled.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }

        if ((int)$captcha !== ($_SESSION['captcha_answer'] ?? -1)) {
            $errors[] = "CAPTCHA failed. Please try again.";
        }

        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/register'));
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Create user
        $userId = $this->userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'alumni',
            'active' => 1,
            'is_alumni' => $isAlumni,
            'permissions' => []
        ]);

        if (!$userId) {
            $_SESSION['form_errors'] = ["User registration failed. Email may already be taken."];
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/register'));
            exit;
        }
        // print("Test");
        // exit();

        // Create profile with basic details only
        $this->profileModel->create([
            'user_id' => $userId,
            'full_name' => $name, // ✅ Pass name as full_name
            'reg_no' => $regNo,
            'father_name' => $fatherName,
            'cnic' => $cnic,
            'email' => $email
        ]);
        $_SESSION['user'] = $this->userModel->read($userId);
        $_SESSION['flash_message'] = "Welcome, " . htmlspecialchars($name) . "!";
        header('Location: ' . $basePath . '/');
        exit;
    }

    public function viewProfile() {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        $profile = $this->profileModel->getByUserId($_SESSION['user']['id']);

        include __DIR__ . '/../../public/views/view_profile.php';
    }

    public function updateProfileForm() {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        $profile = $this->profileModel->getByUserId($_SESSION['user']['id']);

        if (!$profile) {
            $_SESSION['form_errors'] = ['Profile not found.'];
            header("Location: /dashboard");
            exit;
        }

        include __DIR__ . '/../../public/views/update_profile.php';
    }

    public function updateProfileHandler() {


        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        $profileId = $_POST['profile_id'];
        $errors = [];

        $graduationYear = trim($_POST['graduation_year']);
        if (!$graduationYear || $graduationYear < 2000 || $graduationYear > date('Y')) {
            $errors[] = "Graduation year must be valid.";
        }

        $profilePictureName = $_POST['old_profile_picture'] ?? '';
        if (!empty($_FILES['profile_picture']['name'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($_FILES['profile_picture']['type'], $allowedTypes)) {
                $errors[] = "Only JPG, PNG, or WebP images are allowed.";
            } elseif ($_FILES['profile_picture']['size'] > 2 * 1024 * 1024) {
                $errors[] = "Image size should not exceed 2MB.";
            } else {
                $ext = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
                $profilePictureName = uniqid('profile_', true) . '.' . $ext;
                move_uploaded_file($_FILES['profile_picture']['tmp_name'], __DIR__ . '/../../public/uploads/' . $profilePictureName);
            }
        }

        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/profile/update'));
            exit;
        }

        $this->profileModel->update($profileId, [
            'graduation_year' => $graduationYear,
            'department' => $_POST['department'] ?? '',
            'program' => $_POST['program'] ?? '',
            'education_level_id' => $_POST['education_level_id'] ?? null,
            'additional_qualifications' => $_POST['additional_qualifications'] ?? '',
            'current_city' => $_POST['current_city'] ?? '',
            'current_position' => $_POST['current_position'] ?? '',
            'company_name' => $_POST['company_name'] ?? '',
            'job_type' => $_POST['job_type'] ?? '',
            'experience_years' => $_POST['experience_years'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'linkedin_url' => $_POST['linkedin_url'] ?? '',
            'portfolio_url' => $_POST['portfolio_url'] ?? '',
            'profile_picture' => $profilePictureName,
            'is_profile_public' => isset($_POST['is_profile_public']) ? 1 : 0,
            'show_contact_info' => isset($_POST['show_contact_info']) ? 1 : 0,
            'show_position' => isset($_POST['show_position']) ? 1 : 0
        ]);

        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/profile/update'));
        exit;
    }

    public function changePasswordHandler() {
        if (!isset($_SESSION['user'])) {
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/login'));
            exit;
        }

        $errors = [];
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if (!$current || !$new || !$confirm) {
            $errors[] = "All fields are required.";
        }

        if ($new !== $confirm) {
            $errors[] = "New passwords do not match.";
        }

        $user = $this->userModel->read($_SESSION['user']);

        if (!password_verify($current, $user['password'])) {
            $errors[] = "Current password is incorrect.";
        }

        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/change-password'));
            exit;
        }

        $hashed = password_hash($new, PASSWORD_BCRYPT);
        $this->userModel->updatePassword($user['id'], $hashed);

        $_SESSION['success_message'] = "Password changed successfully.";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/change-password'));
        exit;
    }
}
