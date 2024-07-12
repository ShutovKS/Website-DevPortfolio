<?php

namespace App\Kernel\Container;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;
use App\Kernel\View\View;

readonly class Container
{
    public Request $request;
    public Router $router;
    public View $view;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->request = Request::createFromGlobals();
        $this->view = new View();
        $this->router = new Router($this->view, $this->request);
    }
}