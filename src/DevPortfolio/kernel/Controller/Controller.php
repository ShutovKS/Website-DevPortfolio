<?php

namespace App\Kernel\Controller;

use App\Kernel\View\View;

readonly class Controller
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function view(string $view): void
    {
        $this->view->page($view);
    }
}