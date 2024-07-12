<?php

namespace App;

use App\Http\Request;
use App\Router\Router;

class app
{
    public function run(): void
    {
        $router = new Router();
        $request = Request::createFromGlobals();

        $router->dispatch($request->uri(), $request->method());
    }
}