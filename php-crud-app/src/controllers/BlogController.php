<?php

namespace App\Controllers;

use App\Models\Blog;

class BlogController
{
    public function index()
    {
        $blogs = Blog::all();
        require_once '../views/blogs.php';
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        require_once '../views/blog_detail.php';
    }

    public function create()
    {
        require_once '../views/create_blog.php';
    }

    public function store($data)
    {
        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->description = $data['description'];
        $blog->status = $data['status'];
        $blog->save();
        header('Location: /blogs.php');
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        require_once '../views/edit_blog.php';
    }

    public function update($id, $data)
    {
        $blog = Blog::find($id);
        $blog->title = $data['title'];
        $blog->description = $data['description'];
        $blog->status = $data['status'];
        $blog->save();
        header('Location: /blogs.php');
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        header('Location: /blogs.php');
    }
}