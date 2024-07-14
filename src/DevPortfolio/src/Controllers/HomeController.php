<?php

namespace App\Controllers;

class HomeController extends AbstractController
{
    public function index(): void
    {
        $isAuth = $this->isAuth();

        $this->view('home', [
            'isAuth' => $isAuth,
        ], 'Home');
    }

    private function isAuth(): bool
    {
        return $this->identification()->isAuthorized();
    }
}