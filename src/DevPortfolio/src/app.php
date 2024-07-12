<?php

namespace App;
class app
{
    public function run(): void
    {
        $routes = require APP_PATH . '/config/routes.php';
        $route = $_SERVER['REQUEST_URI'];
        $routes[$route]();
    }
}