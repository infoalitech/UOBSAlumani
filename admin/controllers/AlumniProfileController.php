<?php
namespace Admin\Controllers;

use Admin\Models\AlumniProfile;

class AlumniProfileController extends BaseController {
    private $profileModel;

    public function __construct() {
        parent::__construct();
        $this->profileModel = new AlumniProfile($this->db);
    }

    /**
     * Show a specific alumni profile by user ID
     */
    public function view($userId) {
        $profile = $this->profileModel->getByUserId($userId);

        if (!$profile) {
            $this->adminView('profiles/view', ['message' => 'Profile not found.']);
            return;
        }

        $this->adminView('profiles/view', ['profile' => $profile]);
    }

    /**
     * Create a new alumni profile
     */
    public function create($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $userId,
                'graduation_year' => $_POST['graduation_year'],
                'department' => $_POST['department'],
                'program' => $_POST['program'],
                'phone' => $_POST['phone'],
                'current_city' => $_POST['current_city'],
                'current_position' => $_POST['current_position'],
                'company_name' => $_POST['company_name'],
                'linkedin_url' => $_POST['linkedin_url'],
                'profile_picture' => $_POST['profile_picture'] ?? null
            ];

            $this->profileModel->create($data);
            $this->redirect("/admin/profiles/view/{$userId}");
        }

        $this->adminView('profiles/create', ['user_id' => $userId]);
    }

    /**
     * Edit an existing alumni profile
     */
    public function edit($id) {
        $profile = $this->profileModel->getById($id);

        if (!$profile) {
            die("Profile not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'graduation_year' => $_POST['graduation_year'],
                'department' => $_POST['department'],
                'program' => $_POST['program'],
                'phone' => $_POST['phone'],
                'current_city' => $_POST['current_city'],
                'current_position' => $_POST['current_position'],
                'company_name' => $_POST['company_name'],
                'linkedin_url' => $_POST['linkedin_url'],
                'profile_picture' => $_POST['profile_picture'] ?? null
            ];

            $this->profileModel->update($id, $data);
            $this->redirect("/admin/profiles/view/{$profile['user_id']}");
        }

        $this->adminView('profiles/edit', ['profile' => $profile]);
    }

    /**
     * Delete an alumni profile
     */
    public function delete($id) {
        $profile = $this->profileModel->getById($id);
        if ($profile) {
            $this->profileModel->delete($id);
            $this->redirect("/admin/users");
        } else {
            die("Profile not found.");
        }
    }
}
