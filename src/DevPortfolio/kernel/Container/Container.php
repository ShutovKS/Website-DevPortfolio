<?php

namespace App\Kernel\Container;

use App\Kernel\Controller\Controller;
use App\Kernel\Controller\ControllerInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Redirect\Redirect;
use App\Kernel\Redirect\RedirectInterface;
use App\Kernel\Router\Router;
use App\Kernel\Router\RouterInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validator\Validator;
use App\Kernel\Validator\ValidatorInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;
use RuntimeException;

class Container implements ContainerInterface
{
    private array $services;

    public function __construct()
    {
        $this->set('ViewInterface', new View());
        $this->set('ValidatorInterface', new Validator());
        $this->set('RedirectInterface', new Redirect());
        $this->set('SessionInterface', new Session());
        $this->set('RequestInterface', Request::createFromGlobals());
        $this->set('RouterInterface', new Router(
            $this->get('ViewInterface'),
            $this->get('RequestInterface'),
            $this->get('ValidatorInterface'),
            $this->get('RedirectInterface'),
            $this->get('SessionInterface'),
        ));
    }

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new RuntimeException("Service $id not found");
        }

        if (is_string($this->services[$id])) {
            $this->services[$id] = new $this->services[$id]();
        }

        return $this->services[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    public function set(string $id, mixed $value): void
    {
        $this->services[$id] = $value;
    }
}

interface ContainerInterface
{
    public function get(string $id): mixed;

    public function has(string $id): bool;

    public function set(string $id, mixed $value): void;
}