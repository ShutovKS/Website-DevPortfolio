<?php

namespace App\Kernel\Services\Redirect;

interface RedirectInterface
{
    public function to(string $url): void;
}