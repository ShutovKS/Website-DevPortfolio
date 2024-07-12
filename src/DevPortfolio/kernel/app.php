<?php

namespace App\Kernel;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;

class app
{
    public function run(): void
    {
        $router = new Router();
        $request = Request::createFromGlobals();

        $router->dispatch($request->uri(), $request->method());
    }
}