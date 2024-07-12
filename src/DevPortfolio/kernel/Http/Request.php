<?php

namespace App\Kernel\Http;

readonly class Request implements RequestInterface
{
    public function __construct(
        public array $get,
        public array $post,
        public array $server,
        public array $files,
        public array $cookie
    )
    {
    }

    public static function createFromGlobals(): static
    {
        return new static(
            $_GET,
            $_POST,
            $_SERVER,
            $_FILES,
            $_COOKIE,
        );
    }

    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }
}

interface RequestInterface
{
    public static function createFromGlobals(): static;

    public function uri(): string;

    public function method(): string;

    public function input(string $key, mixed $default = null): mixed;
}