<?php

namespace App\Kernel\View;

class View
{
    public function page(string $name): void
    {
        $path = APP_PATH . "/views/pages/{$name}.php";
        extract([
            'view' => $this,
        ]);

        if (!file_exists($path)) {
            $path = APP_PATH . "/views/pages/404.php";
        }


        require_once $path;
    }

    public function component(string $name): void
    {
        $path = APP_PATH . "/views/components/{$name}.php";

        if (!file_exists($path)) {
            echo "<h1>Component not found</h1>";
            return;
        }

        require_once $path;
    }
}