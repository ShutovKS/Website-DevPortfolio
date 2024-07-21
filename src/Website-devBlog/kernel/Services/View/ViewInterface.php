<?php

namespace App\Kernel\Services\View;

interface ViewInterface
{
    public function page(string $name, array $data = [], string $title = ''): void;

    public function component(string $name): void;
}