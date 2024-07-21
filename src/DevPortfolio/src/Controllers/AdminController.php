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
        $data = $this->getData();

        $users = User::all();
        $data['number_users'] = count($users);

        $articles = Articles::all();
        $data['number_articles'] = count($articles);

        $this->view('admin/dashboard', $data, 'Admin dashboard');
    }

    public function listUsers(): void
    {
        $data = $this->getData();

        $users = User::all();
        $data['users'] = $users;

        $this->view('admin/list_users', $data, 'Admin list users');
    }

    public function listArticles(): void
    {
        $data = $this->getData();

        $articles = Articles::all();
        $data['articles'] = $articles;

        $this->view('admin/list_articles', $data, 'Admin list articles');
    }

    protected function getData(array $data = []): array
    {
        $data = parent::getData($data);

        return $data;
    }
}