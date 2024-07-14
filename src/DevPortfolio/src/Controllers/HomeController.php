<?php

namespace App\Controllers;

class HomeController extends AbstractController
{
    public function index(): void
    {
        $isAuth = $this->isAuth();

        $this->view('home',
            ['isAuth' => $isAuth],
            'Home'
        );
    }

    public function about(): void
    {
        $isAuth = $this->isAuth();

        $this->view('/other/about',
            ['isAuth' => $isAuth],
            'About'
        );
    }

    public function faq(): void
    {
        $isAuth = $this->isAuth();

        $this->view('/other/faq',
            ['isAuth' => $isAuth],
            'FAQ'
        );
    }

    private function isAuth(): bool
    {
        return $this->identification()->isAuth();
    }
}