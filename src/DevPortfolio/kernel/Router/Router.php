<?php

namespace App\Kernel\Router;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Request;
use App\Kernel\View\View;

class Router
{
    /** @var Route[] */
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];


    public function __construct(
        private readonly View    $view,
        private readonly Request $request)
    {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route) {
            $this->notFound();
            return;
        }

        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();

            /** @var Controller $controller */
            $controller = new $controller();

            $controller->setView($this->view);
            $controller->setRequest($this->request);

            $controller->$action();
        } else {
            call_user_func($route->getAction());
        }
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo '<h1>404 | Not Found</h1>';
    }

    private function findRoute(string $uri, string $method): ?Route
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