<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\View\View;

abstract class Controller
{
    private View $view;
    private Request $request;

    public function __construct()
    {
        $this->view = new View();
    }

    public function view(string $name, array $data = [], string $title = ''): void
    {
        $this->view->page($name, $data, $title);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

}