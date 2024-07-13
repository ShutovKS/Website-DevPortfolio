<?php

use App\Controllers\AdminController;
use App\Controllers\HomeController;
use App\Kernel\Services\Router\Route;

return [
    Route::get('/home', [HomeController:: class, 'index']),

    Route::get('/admin/add', [AdminController:: class, 'add']),

    Route::post('/admin/add', [AdminController:: class, 'print']),
];