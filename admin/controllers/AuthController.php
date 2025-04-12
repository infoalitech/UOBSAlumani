<?php
namespace Admin\Controllers;

use Admin\Models\User;

class AuthController extends BaseController {
    private $userModel;

    public function __construct() {
        // Call the parent constructor to initialize the database connection
        parent::__construct();
        $this->userModel = new User($this->db);
        // Now, $this->db is available for use (assumed to be a PDO instance)
    }

    public function login($basePath) {
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve submitted credentials.
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            // Start session early to set error messages.
            // session_start();
            // try {
                // First, count the total number of users in the database.
                $countStmt = $this->db->query("SELECT COUNT(*) as total FROM users");
                $countResult = $countStmt->fetch(\PDO::FETCH_ASSOC);
                $totalUsers = (int) $countResult['total'];
    
                // Check if a user exists with the provided username.
                $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :username LIMIT 1");
                $stmt->execute([':username' => $username]);
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);
                // If there are no users, automatically create the user.


                if ($totalUsers === 0) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $insertStmt = $this->db->prepare("INSERT INTO users (email, password, name, active) VALUES (:email, :password, :name, :active)");
                    $insertStmt->execute([
                        ':email'    => $username,
                        ':password' => $hashedPassword,
                        ':name'     => $username, // Modify as needed if a different name is available.
                        ':active'   => 1
                    ]);
    
                    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :username LIMIT 1");
                    $stmt->execute([':username' => $username]);
                    $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['email'];
                    $_SESSION['is_super_user'] = $user['is_super_user'];
                    
                    // ✅ Fix: Ensure `getUserPermissions()` method exists
                    if (method_exists($this->userModel, 'getUserPermissions')) {
                        $_SESSION['permissions'] = $this->userModel->getUserPermissions($user['id']);
                    } else {
                        $_SESSION['permissions'] = [];
                    }

                    header('Location: ' . $basePath . '/admin/dashboard');
                    exit;
                } else {


                    // For an existing system, check if the user exists.
                    if ($user) {
                        // Verify the password.
                        if (password_verify($password, $user['password'])) {
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['username'] = $user['email'];
                            $_SESSION['user'] = $user;
                            $_SESSION['is_super_user'] = $user['is_super_user'];

                            // ✅ Fix: Ensure `getUserPermissions()` method exists
                            if (method_exists($this->userModel, 'getUserPermissions')) {
                                $_SESSION['permissions'] = $this->userModel->getUserPermissions($user['id']);
                            } else {
                                $_SESSION['permissions'] = [];
                            }
                            header('Location: ' . $basePath . '/admin/dashboard');
                            exit;
                        } else {
                            $_SESSION['error'] = 'Invalid username or password';
                            header('Location: ' . $basePath . '/login');
                            exit;
                        }
                    } else {
                        // If user does not exist and there are already registered users,
                        // do not create a new user automatically.
                        $_SESSION['error'] = 'User does not exist';
                        header('Location: ' . $basePath . '/login');
                        exit;
                    }
                }
            // } catch (\PDOException $e) {
            //     echo 'Database error: ' . $e->getMessage();
            // }
        }
    }
    

    public function logout() {
        // session_start();
        session_destroy();
        header('Location: login');
        exit;
    }
}
?>
