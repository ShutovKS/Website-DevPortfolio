<?php

namespace App\Controllers;

class HomeController extends AbstractController
{
    public function index(): void
    {
        $this->view('home',
            ['isAuth' => $this->isAuth()],
            'Home'
        );
    }

    public function about(): void
    {
        $this->view('/other/about',
            ['isAuth' => $this->isAuth()],
            'About'
        );
    }

    public function faq(): void
    {
        $this->view('/other/faq',
            ['isAuth' => $this->isAuth()],
            'FAQ'
        );
    }

    private function isAuth(): bool
    {
        return $this->identification()->isAuth();
    }
}