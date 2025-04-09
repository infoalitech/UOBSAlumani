<?php
namespace Admin\Controllers;

use Admin\Models\User;
use Admin\Models\JobPost;

class AlumniJobController extends BaseController {
    private $profileModel;

    public function __construct() {
        parent::__construct();
        $this->profileModel = new JobPost($this->db);
    }




}