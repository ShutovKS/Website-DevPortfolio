<?php

namespace App\Kernel\Services\Http;

interface RedirectInterface
{
    public function to(string $url): void;
}