<?php

namespace App\Kernel\Container;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Request;
use App\Kernel\Router\Router;
use App\Kernel\View\View;

readonly class Container
{
    public Request $request;
    public Router $router;
    public Controller $controller;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->request = Request::createFromGlobals();
        $this->controller = new Controller();
        $this->router = new Router($this->controller);
    }
}