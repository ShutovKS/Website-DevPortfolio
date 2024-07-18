<?php

namespace App\Controllers;

class AdminController extends AbstractController
{
    public function index(): void
    {
        $this->view('home', $this->getData(), 'Home');
    }

    private function getData(): array
    {
        $isAuth = $this->identification()->isAuth();
        $link_to_photo = null;

        if ($isAuth === true) {
            $link_to_photo = $this->identification()->getUser()->linkToPhoto;
        }

        return [
            'isAuth' => $isAuth,
            'link_to_photo' => $link_to_photo,
        ];
    }
}