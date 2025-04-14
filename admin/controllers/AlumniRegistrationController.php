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

        // Get & trim inputs
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $graduationYear = trim($_POST['graduation_year'] ?? '');
        $department = trim($_POST['department'] ?? '');
        $program = trim($_POST['program'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $captcha = $_POST['captcha'] ?? '';
        $isAlumni = isset($_POST['is_alumni']) ? 1 : 0;

        // Store old inputs to repopulate form on error
        $_SESSION['old_input'] = $_POST;

        // Validations
        if (!$name || !$email || !$graduationYear || !$password || !$confirmPassword || !$captcha) {
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

        // if (!empty($errors)) {
        //     $_SESSION['form_errors'] = $errors;
        //     header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/register'));
        //     exit;
        // }

        // Hash password
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

        // print($userId);
        // exit();
        if (!$userId) {
            $_SESSION['form_errors'] = ["User registration failed. Email may already be taken."];
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/register'));
            exit;
        }

        // Create alumni profile
        $this->profileModel->create([
            'user_id' => $userId,
            'graduation_year' => $graduationYear,
            'department' => $department,
            'program' => $program,
            'phone' => $phone,
            'current_city' => '',
            'current_position' => '',
            'company_name' => '',
            'linkedin_url' => '',
            'profile_picture' => ''
        ]);

        // Fetch full user record to log in
        $user = $this->userModel->read($userId);

        // Auto login
        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['email'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['is_super_user'] = $user['is_super_user'] ?? 0;
        $_SESSION['is_alumni'] = $user['is_alumni'] ?? 1;

        // Optional: Flash welcome
        $_SESSION['flash_message'] = "Welcome, " . htmlspecialchars($user['name']) . "!";

        // Redirect to dashboard or profile
        header('Location: '.$basePath.'/');
        exit;
    }

    public function viewProfile() {
    
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
    
        $profile = $this->profileModel->getByUserId($_SESSION['user_id']);
    
        include __DIR__ . '/../../public/views/view_profile.php';
    }
    


    public function updateProfileForm() {
        if (!isset($_SESSION['username'])) {
            header("Location: /login");
            exit;
        }
        $profile = $this->profileModel->getByUserId($_SESSION['user_id']);
        if (!$profile) {
            $_SESSION['form_errors'] = ['Profile not found.'];
            header("Location: /dashboard");
            exit;
        }
    
        include __DIR__ . '/../../public/views/update_profile.php';
    }
    
    public function updateProfileHandler() {
        session_start();
    
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
    
        $profileId = $_POST['profile_id'];
        $errors = [];
    
        // Basic validation
        $graduation_year = trim($_POST['graduation_year']);
        if (!$graduation_year || $graduation_year < 2000 || $graduation_year > date('Y')) {
            $errors[] = "Graduation year must be valid.";
        }

        // Handle image upload
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
            'graduation_year' => $graduation_year,
            'phone' => $_POST['phone'] ?? '',
            'department' => $_POST['department'] ?? '',
            'program' => $_POST['program'] ?? '',
            'current_city' => $_POST['current_city'] ?? '',
            'current_position' => $_POST['current_position'] ?? '',
            'company_name' => $_POST['company_name'] ?? '',
            'linkedin_url' => $_POST['linkedin_url'] ?? '',
            'profile_picture' => $profilePictureName
        ]);
    
        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/profile/update'));

        exit;
    }

    public function changePasswordHandler() {
        
        if (!isset($_SESSION['user_id'])) {
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
    
        $user = $this->userModel->read($_SESSION['user_id']);
        
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
