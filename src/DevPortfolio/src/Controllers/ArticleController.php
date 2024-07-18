<?php

namespace App\Controllers;

use App\Models\Articles;

class ArticleController extends AbstractController
{
    public function openCreated(): void
    {
        $errors = $this->session()->get('errors');
        $this->session()->remove('errors');

        $this->view(
            '/article/article_created',
            [
                'errors' => $errors,
            ],
            'Article created');
    }

    public function create(): void
    {
        $title = $this->request()->input('title');
        $content = $this->request()->input('content');

        $errors = [];

        if (empty($title)) {
            $errors['title'] = 'Title is required';
        }

        if (empty($content)) {
            $errors['content'] = 'Content is required';
        }

        if (!empty($errors)) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/article/created');
        }

        $article = new Articles();

        $article->userId = $this->identification()->getUser()->id;
        $article->title = $title;
        $article->content = $content;
        $article->createdAt = date('Y-m-d H:i:s');
        $article->updatedAt = date('Y-m-d H:i:s');
        $article->published = 1;

        $article->save();

        $this->redirect()->to('../user/profile');
    }
}