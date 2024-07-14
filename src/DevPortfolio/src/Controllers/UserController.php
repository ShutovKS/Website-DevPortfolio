<?php

namespace App\Controllers;

class UserController extends AbstractController
{
    public function index(): void
    {
        $this->view('user/profile', [], 'Profile');
    }


}