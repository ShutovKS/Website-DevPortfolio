<?php

namespace App\Controllers;

class HomeController extends AbstractController
{
    public function index(): void
    {
        $isAuth = $this->isAuth();

        $this->view('home', [
            'isAuth' => $isAuth,
        ], 'Главная страница');
    }

    private function isAuth(): bool
    {
        return $this->identification()->isAuthorized();
    }
}