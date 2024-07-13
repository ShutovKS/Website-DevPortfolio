<?php

namespace App\Kernel\Services\Redirect;

class Redirect implements RedirectInterface
{
    public function to(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}

interface RedirectInterface
{
    public function to(string $url): void;
}