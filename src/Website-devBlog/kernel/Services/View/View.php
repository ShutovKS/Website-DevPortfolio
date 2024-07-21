<?php

namespace App\Kernel\Services\View;

class View implements ViewInterface
{
    public function page(string $name, array $data = [], string $title = ''): void
    {
        $path = APP_PATH . "/views/pages/$name.php";

        extract([
            'view' => $this,
            'data' => $data,
            'title' => $title,
        ]);

        if (!file_exists($path)) {
            $path = APP_PATH . "/views/pages/error/404.php";
        }

        require_once $path;
    }

    public function component(string $name, array $data = []): void
    {
        $path = APP_PATH . "/views/components/$name.php";

        extract([
            'data' => $data,
            'view' => $this,
        ]);

        if (!file_exists($path)) {
            echo "<h1>Component not found</h1>";
            return;
        }

        require_once $path;
    }
}

