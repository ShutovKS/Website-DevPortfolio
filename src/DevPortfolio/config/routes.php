<?php

use App\Controllers\AdminController;
use App\Controllers\HomeController;
use App\Controllers\IdentificationController;
use App\Kernel\Services\Router\Route;
use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

return [
    // -- home

    Route::get('/', [HomeController:: class, 'index']),
    Route::get('/home', [HomeController:: class, 'index']),

    // -- other

    Route::get('/about', [HomeController:: class, 'about']),
    Route::get('/faq', [HomeController:: class, 'faq']),

    // -- identification

    Route::get('/identification/login', [IdentificationController:: class, 'open_login_page'], [AuthMiddleware::class]),
    Route::get('/identification/signup', [IdentificationController::class, 'open_registration_page'], [AuthMiddleware::class]),

    Route::get('/identification/logout', [IdentificationController::class, 'logout'], [GuestMiddleware::class]),

    Route::get('/identification/recover_password', [IdentificationController::class, 'processPasswordRecovery'], [AuthMiddleware::class]),

    Route::get('/identification/completed', [IdentificationController::class, 'completed']),

    Route::post('/identification/login', [IdentificationController:: class, 'login_processing'], [AuthMiddleware::class]),
    Route::post('/identification/register', [IdentificationController:: class, 'registration_processing'], [AuthMiddleware::class]),

    // -- error

//    Route::get('/error/404', [null, 'error_404']),

    // -- admin

    Route::get('/admin/home', [AdminController::class, 'index'], [GuestMiddleware::class, AdminMiddleware::class]),
];