<?php

namespace App\Controllers;

use App\Models\Articles;
use App\Models\User;

class AdminController extends AbstractController
{
    public function index(): void
    {
        $this->view('admin/home', $this->getData(), 'Admin home');
    }

    public function dashboard(): void
    {
        /** @var User[] $users */
        $users = User::all();

        /** @var Articles[] $articles */
        $articles = Articles::all();

        $data = $this->getData([
            'number_users' => count($users),
            'number_articles' => count($articles),
        ]);

        $this->view('admin/dashboard', $data, 'Admin dashboard');
    }

    public function listUsers(): void
    {
        /** @var User[] $users */
        $users = User::all();

        $data = $this->getData(['users' => $users,]);

        $this->view('admin/list_users', $data, 'Admin list users');
    }

    public function listArticles(): void
    {
        /** @var Articles[] $articles */
        $articles = Articles::all();

        $data = $this->getData(['articles' => $articles,]);

        $this->view('admin/list_articles', $data, 'Admin list articles');
    }

}