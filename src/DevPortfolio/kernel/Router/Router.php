<?php

namespace App\Kernel\Router;

use App\Kernel\Controller\Controller;
use App\Kernel\View\View;

class Router
{
    /** @var Route[] */
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    private Controller $controller;

    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
        $this->initRoutes();
    }

    public function dispatch(string $url, string $method): void
    {
        $route = $this->findRoute($method, $url);

        if ($route === null) {
            $this->notFound();
            return;
        }

        if (is_array($route->getAction())) {
            [$controller, $method] = $route->getAction();
            $controller = new $controller($this->controller);
            $controller->$method();
        } else {
            $route->getAction()();
        }
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo '<h1>404 Not Found</h1>';
    }

    private function findRoute(string $method, string $uri): ?Route
    {
        return $this->routes[$method][$uri] ?? null;
    }

    private function initRoutes(): void
    {
        $routes = $this->getRotes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /** @return Route[] */
    private function getRotes(): array
    {
        return require APP_PATH . '/config/routes.php';
    }
}