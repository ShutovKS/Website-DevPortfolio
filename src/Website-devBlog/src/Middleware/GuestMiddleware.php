<?php

namespace App\Middleware;

class GuestMiddleware extends AbstractMiddleware
{
    public function handle(): void
    {
        if ($this->identification->isAuth()) {
            $this->redirect->to('/');
        }
    }
}