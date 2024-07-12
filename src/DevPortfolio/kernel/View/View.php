<?php

namespace App\Kernel\View;

class View
{
    public function page(string $view, array $data = []): void
    {
        extract($data);

        require_once APP_PATH . "/views/pages/{$view}.php";
    }
}