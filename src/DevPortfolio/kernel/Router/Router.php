<?php

namespace App\Kernel\Router;

use App\Kernel\Controller\ControllerInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Redirect\RedirectInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validator\ValidatorInterface;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    /** @var Route[] */
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct(
        private readonly ViewInterface      $view,
        private readonly RequestInterface   $request,
        private readonly ValidatorInterface $validator,
        private readonly RedirectInterface  $redirect,
        private readonly SessionInterface   $session,
    )
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

            /** @var ControllerInterface $controller */
            $controller = new $controller();

            $controller->setView($this->view);
            $controller->setRequest($this->request);
            $controller->setValidator($this->validator);
            $controller->setRedirect($this->redirect);
            $controller->setSession($this->session);

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

interface RouterInterface
{
    public function dispatch(string $uri, string $method): void;
}