<?php

namespace App\Kernel\Services\Router;

readonly class Route
{
    public function __construct(
        private string $method,
        private string $uri,
        private array  $action,
        private array  $middlewares = []
    )
    {
    }

    public static function get(string $uri, array $action = [], array $middlewares = []): self
    {
        return new self('GET', $uri, $action, $middlewares);
    }

    public static function post(string $uri, array $action = [], array $middlewares = []): self
    {
        return new self('POST', $uri, $action, $middlewares);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getAction(): array
    {
        return $this->action;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}