<?php

namespace App\Kernel\Redirect;

class Redirect
{
    public function to(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}