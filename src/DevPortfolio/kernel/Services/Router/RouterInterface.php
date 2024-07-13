<?php

namespace App\Kernel\Services\Router;

interface RouterInterface
{
    public function dispatch(string $uri, string $method): void;
}