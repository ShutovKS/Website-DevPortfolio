<?php

namespace App\Kernel;

use App\Kernel\Container\Container;
use App\Kernel\Container\ContainerInterface;

class app
{
    private static app $instance;
    private ContainerInterface $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function run(): void
    {
        $router = $this->container->getRouter();
        $request = $this->container->getRequest();
        $router->dispatch($request->uri(), $request->method());
    }

    public static function getInstance(): app
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}