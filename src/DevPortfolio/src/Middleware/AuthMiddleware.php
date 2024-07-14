<?php

namespace App\Middleware;

class AuthMiddleware extends AbstractMiddleware
{
    public function handle(): void
    {
        if ($this->identification->isAuth()) {
            $this->redirect->to('/');
        }
    }
}