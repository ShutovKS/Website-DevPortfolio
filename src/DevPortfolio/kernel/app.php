<?php

namespace App\Kernel;

use App\Kernel\Container\Container;
use App\Kernel\Container\ContainerInterface;

class app
{
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
}