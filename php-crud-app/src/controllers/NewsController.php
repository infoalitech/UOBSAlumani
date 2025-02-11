<?php

namespace App\Controllers;

use App\Models\News;

class NewsController
{
    public function index()
    {
        $news = News::all();
        require_once '../src/views/news.php';
    }

    public function show($id)
    {
        $newsItem = News::find($id);
        require_once '../src/views/news_detail.php';
    }

    public function create()
    {
        require_once '../src/views/create_news.php';
    }

    public function store($data)
    {
        $news = new News();
        $news->name = $data['name'];
        $news->description = $data['description'];
        $news->status = $data['status'];
        $news->date = $data['date'];
        $news->end_date = $data['end_date'];
        $news->save();
        header('Location: /news.php');
    }

    public function edit($id)
    {
        $newsItem = News::find($id);
        require_once '../src/views/edit_news.php';
    }

    public function update($id, $data)
    {
        $news = News::find($id);
        $news->name = $data['name'];
        $news->description = $data['description'];
        $news->status = $data['status'];
        $news->date = $data['date'];
        $news->end_date = $data['end_date'];
        $news->save();
        header('Location: /news.php');
    }

    public function delete($id)
    {
        $news = News::find($id);
        $news->delete();
        header('Location: /news.php');
    }
}