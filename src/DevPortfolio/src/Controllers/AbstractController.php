<?php

namespace App\Controllers;

use App\Kernel\Services\Http\RequestInterface;
use App\Kernel\Services\Redirect\RedirectInterface;
use App\Kernel\Services\Session\SessionInterface;
use App\Kernel\Services\Validator\ValidatorInterface;
use App\Kernel\Services\View\ViewInterface;

abstract class AbstractController implements ControllerInterface
{
    private ViewInterface $view;
    private RequestInterface $request;
    private ValidatorInterface $validator;
    private RedirectInterface $redirect;
    private SessionInterface $session;

    public function view(string $name, array $data = [], string $title = ''): void
    {
        $this->view->page($name, $data, $title);
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function validator(): ValidatorInterface
    {
        return $this->validator;
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function redirect(): RedirectInterface
    {
        return $this->redirect;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function session(): SessionInterface
    {
        return $this->session;
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }
}

interface ControllerInterface
{
    public function view(string $name, array $data = [], string $title = ''): void;

    public function setView(ViewInterface $view): void;

    public function request(): RequestInterface;

    public function setRequest(RequestInterface $request): void;

    public function validator(): ValidatorInterface;

    public function setValidator(ValidatorInterface $validator): void;

    public function redirect(): RedirectInterface;

    public function setRedirect(RedirectInterface $redirect): void;

    public function session(): SessionInterface;

    public function setSession(SessionInterface $session): void;
}