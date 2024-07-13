<?php

namespace App\Kernel\Services\Session;

interface SessionInterface
{
    public function set(string $key, $value): void;

    public function get(string $key);

    public function remove(string $key): void;

    public function destroy(): void;
}