<?php

namespace App\Controllers;

use App\Models\Job;

class JobController
{
    public function index()
    {
        $jobs = Job::all();
        require_once '../views/jobs.php';
    }

    public function show($id)
    {
        $job = Job::find($id);
        require_once '../views/job_detail.php';
    }

    public function create()
    {
        require_once '../views/create_job.php';
    }

    public function store($data)
    {
        Job::create($data);
        header('Location: /jobs.php');
    }

    public function edit($id)
    {
        $job = Job::find($id);
        require_once '../views/edit_job.php';
    }

    public function update($id, $data)
    {
        Job::update($id, $data);
        header('Location: /jobs.php');
    }

    public function destroy($id)
    {
        Job::delete($id);
        header('Location: /jobs.php');
    }
}