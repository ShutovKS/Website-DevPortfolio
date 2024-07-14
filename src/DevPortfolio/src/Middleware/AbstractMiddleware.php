<?php

namespace App\Middleware;

use App\Kernel\Services\Http\RedirectInterface;
use App\Kernel\Services\Http\RequestInterface;
use App\Kernel\Services\Identification\IdentificationInterface;
use App\Kernel\Services\Session\SessionInterface;

abstract class AbstractMiddleware
{
    public function __construct(
        protected RequestInterface        $request,
        protected IdentificationInterface $identification,
        protected RedirectInterface       $redirect,
        protected SessionInterface        $session
    )
    {
    }

    abstract public function handle(): void;
}