<?php

namespace App\Middleware;

class AdminMiddleware extends AbstractMiddleware
{
    public function handle(): void
    {
        if (!$this->identification->isAdmin()) {
            $this->redirect->to('/home');
        }
    }
}