<?php

namespace App\Controllers;

use App\Models\Articles;

class HomeController extends AbstractController
{
    public function index(): void
    {
        $data = $this->getData();
        $data['articles'] = Articles::getRandom(9);

        $this->view('home', $data, 'Home');
    }

    public function about(): void
    {
        $this->view('/other/about', $this->getData(), 'About');
    }

    public function faq(): void
    {
        $this->view('/other/faq', $this->getData(), 'FAQ');
    }

    private function getData(): array
    {
        $errors = $this->session()->get('errors');
        $this->session()->remove('errors');

        $isAuth = $this->identification()->isAuth();
        $link_to_photo = null;

        if ($isAuth === true) {
            $link_to_photo = $this->identification()->getUser()->linkToPhoto;
        }

        return [
            'isAuth' => $isAuth,
            'link_to_photo' => $link_to_photo,
            'errors' => $errors,
        ];
    }
}