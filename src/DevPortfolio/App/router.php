<?php


namespace App;

class router
{
    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('?', $uri);
        $uri = $uri[0];
        $uri = trim($uri, '/');
        $uri = explode('/', $uri);

        $controller = 'index';
        $action = 'index';
        $params = [];

        if (!empty($uri[0])) {
            $controller = $uri[0];
        }

        if (!empty($uri[1])) {
            $action = $uri[1];
        }

        if (!empty($uri[2])) {
            $params = array_slice($uri, 2);
        }

        $controller = 'app\\controllers\\' . $controller;
        $controller = new $controller();

        if (!method_exists($controller, $action)) {
            $action = 'index';
        }

        call_user_func_array([$controller, $action], $params);
    }
}