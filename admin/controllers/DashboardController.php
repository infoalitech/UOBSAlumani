<?php
namespace Admin\Controllers;

use App\Helpers\Config; // Import the Config class

class DashboardController {
    private $basePath;
    private $displayErrors;

    public function __construct()
    {
        // Assign values to class properties
        $this->basePath = rtrim(Config::get('BASE_PATH', '/UOBSAlumani/public'), '/') . '/';
        $this->displayErrors = Config::get('DISPLAY_ERRORS', false);
    }

    public function dashboard(){
        include(__DIR__.'/../views/dashboard.php');
    }

}
?>
