<?php

use App\Controllers\HomeController;
use App\Kernel\Router\Route;

return [
    Route::get('/home', [HomeController:: class, 'index']),
];