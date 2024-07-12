<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\Redirect\Redirect;
use App\Kernel\Session\Session;
use App\Kernel\Validator\Validator;
use App\Kernel\View\View;

abstract class Controller
{
    private View $view;
    private Request $request;
    private Validator $validator;
    private Redirect $redirect;
    private Session $session;

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

    public function validator(): Validator
    {
        return $this->validator;
    }

    public function setValidator(Validator $validator): void
    {
        $this->validator = $validator;
    }

    public function redirect(): Redirect
    {
        return $this->redirect;
    }

    public function setRedirect(Redirect $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function session(): Session
    {
        return $this->session;
    }

    public function setSession(Session $session): void
    {
        $this->session = $session;
    }
}