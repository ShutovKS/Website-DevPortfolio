<?php

namespace App\Kernel\Services\Middleware;

use App\Kernel\Services\Http\RequestInterface;
use App\Kernel\Services\Identification\IdentificationInterface;
use App\Kernel\Services\Redirect\RedirectInterface;
use App\Kernel\Services\Session\SessionInterface;

interface MiddlewareInterface
{
    public function check(array $middlewares = []): void;
}

