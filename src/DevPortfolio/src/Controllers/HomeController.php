<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class HomeController
{
    private Controller $controller;

    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function index(): void
    {
        $this->controller->view('home');
    }
}