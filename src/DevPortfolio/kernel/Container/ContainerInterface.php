<?php

namespace App\Kernel\Container;

use App\Kernel\Services\Config\ConfigInterface;
use App\Kernel\Services\Http\RequestInterface;
use App\Kernel\Services\Redirect\RedirectInterface;
use App\Kernel\Services\Router\RouterInterface;
use App\Kernel\Services\Session\SessionInterface;
use App\Kernel\Services\Validator\ValidatorInterface;
use App\Kernel\Services\View\ViewInterface;

interface ContainerInterface
{
    public function getRouter(): RouterInterface;

    public function getRequest(): RequestInterface;

    public function getRedirect(): RedirectInterface;

    public function getSession(): SessionInterface;

    public function getValidator(): ValidatorInterface;

    public function getView(): ViewInterface;
    public function getConfig(): ConfigInterface;
}