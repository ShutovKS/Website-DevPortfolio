<?php

namespace App\Router;

class Router
{
    public function dispatch(string $url): void
    {
        $routes = $this->getRotes();

        $routes[$url]();
    }

    private function getRotes(): array
    {
        return require APP_PATH . '/config/routes.php';
    }
}