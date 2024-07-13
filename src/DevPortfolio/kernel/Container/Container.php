<?php

namespace App\Kernel\Container;

use App\Kernel\Router\Router;
use App\Kernel\Http\Request;
use App\Kernel\Redirect\Redirect;
use App\Kernel\Session\Session;
use App\Kernel\Validator\Validator;
use App\Kernel\View\View;

use App\Kernel\Router\RouterInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Redirect\RedirectInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validator\ValidatorInterface;
use App\Kernel\View\ViewInterface;

class Container implements ContainerInterface
{
    private RouterInterface $router;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private ValidatorInterface $validator;
    private ViewInterface $view;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->validator = new Validator();
        $this->view = new View();

        $this->router = new Router(
            $this->view,
            $this->request,
            $this->validator,
            $this->redirect,
            $this->session
        );
    }

    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getRedirect(): RedirectInterface
    {
        return $this->redirect;
    }

    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    public function getView(): ViewInterface
    {
        return $this->view;
    }
}

interface ContainerInterface
{
    public function getRouter(): RouterInterface;

    public function getRequest(): RequestInterface;

    public function getRedirect(): RedirectInterface;

    public function getSession(): SessionInterface;

    public function getValidator(): ValidatorInterface;

    public function getView(): ViewInterface;
}