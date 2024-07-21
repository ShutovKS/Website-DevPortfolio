<?php

namespace App\Kernel\Services\Http;

class Redirect implements RedirectInterface
{
    public function to(string $url): void
    {
        header('Location: ' . $url);
    }
}

