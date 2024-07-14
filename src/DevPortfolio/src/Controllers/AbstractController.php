<?php

namespace App\Controllers;

use App\Kernel\Services\Database\DatabaseInterface;
use App\Kernel\Services\Http\RedirectInterface;
use App\Kernel\Services\Http\RequestInterface;
use App\Kernel\Services\Identification\IdentificationInterface;
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
    private DatabaseInterface $db;
    private IdentificationInterface $identification;

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

    public function database(): DatabaseInterface
    {
        return $this->db;
    }

    public function setDatabase(DatabaseInterface $db): void
    {
        $this->db = $db;
    }

    public function identification(): IdentificationInterface
    {
        return $this->identification;
    }

    public function setIdentification(IdentificationInterface $identification): void
    {
        $this->identification = $identification;
    }
}

