<?php

namespace App\Kernel\Services\Http;

interface RequestInterface
{
    public static function createFromGlobals(): static;

    public function uri(): string;

    public function method(): string;

    public function input(string $key, mixed $default = null): mixed;
}