<?php

namespace App\Kernel\Services\Router;

use App\Controllers\ControllerInterface;
use App\Kernel\Services\Config\ConfigInterface;
use App\Kernel\Services\Http\RedirectInterface;
use App\Kernel\Services\Http\RequestInterface;
use App\Kernel\Services\Identification\IdentificationInterface;
use App\Kernel\Services\Session\SessionInterface;
use App\Kernel\Services\Validator\ValidatorInterface;
use App\Kernel\Services\View\ViewInterface;
use App\Middleware\AbstractMiddleware;

class Router implements RouterInterface
{
    /** @var Route[] */
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct(
        private readonly ViewInterface           $view,
        private readonly RequestInterface        $request,
        private readonly ValidatorInterface      $validator,
        private readonly RedirectInterface       $redirect,
        private readonly SessionInterface        $session,
        private readonly ConfigInterface         $config,
        private readonly IdentificationInterface $identification
    )
    {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        [$route, $params] = $this->findRoute($uri, $method);

        if (!$route) {
            $this->notFound();
            return;
        }

        foreach ($route->getMiddlewares() as $middleware) {
            /** @var AbstractMiddleware $middleware */
            $middleware = new $middleware(
                $this->request,
                $this->identification,
                $this->redirect,
                $this->session
            );

            $middleware->handle();
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
            $controller->setIdentification($this->identification);
            $controller->setConfig($this->config);

            $controller->$action(...$params);
        } else {
            call_user_func($route->getAction(), ...$params);
        }
    }

    private function findRoute(string $uri, string $method): ?array
    {
        foreach ($this->routes[$method] as $routeUri => $route) {
            $pattern = preg_replace('#\{[\w]+\}#', '([\w-]+)', $routeUri);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches); // Remove the full match
                return [$route, $matches];
            }
        }
        return [null, []];
    }

    private function initRoutes(): void
    {
        $routes = $this->getRotes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private function notFound(): void
    {
        http_response_code(404);
        $this->view->page('errors/404');
    }

    /** @return Route[] */
    private function getRotes(): array
    {
        return $this->config->get('routes');
    }
}

