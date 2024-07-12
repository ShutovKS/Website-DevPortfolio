<?php

namespace App\Kernel\Container;

use App\Kernel\Http\Request;
use App\Kernel\Redirect\Redirect;
use App\Kernel\Router\Router;
use App\Kernel\Session\Session;
use App\Kernel\Validator\Validator;
use App\Kernel\View\View;

readonly class Container
{
    public Request $request;
    public Router $router;
    public View $view;
    public Validator $validator;
    public Redirect $redirect;
    public Session $session;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->request = Request::createFromGlobals();
        $this->view = new View();
        $this->validator = new Validator();
        $this->redirect = new Redirect();
        $this->session = new Session();

        $this->router = new Router($this->view, $this->request, $this->validator, $this->redirect, $this->session);
    }
}