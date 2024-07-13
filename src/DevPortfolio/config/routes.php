<?php

use App\Controllers\HomeController;
use App\Controllers\IdentificationController;
use App\Kernel\Services\Router\Route;

return [
    // -- home

    Route::get('/home', [HomeController:: class, 'index']),

    // -- identification

    Route::get('/identification/login', [IdentificationController:: class, 'open_login_page']),
    Route::get('/identification/open_login_page', [IdentificationController:: class, 'open_login_page']),

    Route::get('/identification/register', [IdentificationController:: class, 'open_registration_page']),
    Route::get('/identification/open_registration_page', [IdentificationController::class, 'open_registration_page']),

    Route::get('/identification/recover_password', [IdentificationController::class, 'processPasswordRecovery']),

    Route::get('/identification/completed', [IdentificationController::class, 'completed']),

    Route::post('/identification/login', [IdentificationController:: class, 'login_processing']),
    Route::post('/identification/register', [IdentificationController:: class, 'registration_processing']),
];