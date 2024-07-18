<?php

use App\Controllers\AdminController;
use App\Controllers\ArticleController;
use App\Controllers\HomeController;
use App\Controllers\IdentificationController;
use App\Controllers\UserController;
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

    Route::get('/identification/login', [IdentificationController:: class, 'openLoginPage'], [GuestMiddleware::class]),
    Route::get('/identification/signup', [IdentificationController::class, 'openRegistrationPage'], [GuestMiddleware::class]),

    Route::get('/identification/logout', [IdentificationController::class, 'logout'], [AuthMiddleware::class]),

    Route::get('/identification/recover_password', [IdentificationController::class, 'processPasswordRecovery'], [GuestMiddleware::class]),

    Route::get('/identification/completed', [IdentificationController::class, 'completed']),

    Route::post('/identification/login', [IdentificationController:: class, 'loginProcessing'], [GuestMiddleware::class]),
    Route::post('/identification/register', [IdentificationController:: class, 'registrationProcessing'], [GuestMiddleware::class]),

    // -- error

//    Route::get('/error/404', [null, 'error_404']),

    // -- article

    Route::get('/article/created', [ArticleController::class, 'openCreated'], [AuthMiddleware::class]),
    Route::post('/article/create', [ArticleController::class, 'create'], [AuthMiddleware::class]),

    // -- user

    Route::get('/user/profile', [UserController::class, 'index'], [AuthMiddleware::class]),
    Route::get('/user/settings', [UserController::class, 'settings'], [AuthMiddleware::class]),

    Route::post('/user/settings/photo', [UserController::class, 'updatePhoto'], [AuthMiddleware::class]),
    Route::post('/user/settings/socials', [UserController::class, 'updateSocials'], [AuthMiddleware::class]),
    Route::post('/user/settings/profile', [UserController::class, 'updateProfile'], [AuthMiddleware::class]),
    Route::post('/user/settings/password', [UserController::class, 'updatePassword'], [AuthMiddleware::class]),
    Route::post('/user/settings/delete', [UserController::class, 'deleteAccount'], [AuthMiddleware::class]),

    // -- admin

    Route::get('/admin/home', [AdminController::class, 'index'], [AuthMiddleware::class, AdminMiddleware::class]),
];