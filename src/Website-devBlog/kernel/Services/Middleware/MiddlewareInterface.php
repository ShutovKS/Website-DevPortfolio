<?php

namespace App\Kernel\Services\Middleware;

interface MiddlewareInterface
{
    public function check(array $middlewares = []): void;
}

