<?php

use App\Controllers\HomeController;
use App\Controllers\IdentificationController;
use App\Kernel\Services\Router\Route;

return [
    Route::get('/home', [HomeController:: class, 'index']),

    Route::get('/identification/login', [IdentificationController:: class, 'open_login_page']),
    Route::post('/identification/login', [IdentificationController:: class, 'login_processing']),
    Route::get('/identification/register', [IdentificationController:: class, 'open_registration_page']),
    Route::post('/identification/register', [IdentificationController:: class, 'registration_processing']),
];