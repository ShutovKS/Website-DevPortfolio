<?php

namespace App\Controllers;

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
}