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

    Route::get('/', [HomeController::class, 'index']),
    Route::get('/home', [HomeController::class, 'index']),

    // -- other

    Route::get('/about', [HomeController::class, 'about']),

    // -- identification

    Route::get('/identification/login', [IdentificationController::class, 'openLoginPage'], [GuestMiddleware::class]),
    Route::get('/identification/signup', [IdentificationController::class, 'openRegistrationPage'], [GuestMiddleware::class]),

    Route::get('/identification/logout', [IdentificationController::class, 'logout'], [AuthMiddleware::class]),

    Route::get('/identification/recover_password', [IdentificationController::class, 'processPasswordRecovery'], [GuestMiddleware::class]),

    Route::get('/identification/completed', [IdentificationController::class, 'completed']),

    Route::post('/identification/login', [IdentificationController::class, 'loginProcessing'], [GuestMiddleware::class]),
    Route::post('/identification/register', [IdentificationController::class, 'registrationProcessing'], [GuestMiddleware::class]),

    // -- error

//    Route::get('/error/404', [null, 'error_404']),

    // -- article

    Route::get('/article/created', [ArticleController::class, 'openCreated'], [AuthMiddleware::class]),
    Route::get('/article/view/{id}', [ArticleController::class, 'viewArticle'], [AuthMiddleware::class]),
    Route::get('/article/edit/{id}', [ArticleController::class, 'editArticle'], [AuthMiddleware::class]),
    Route::get('/article/delete/{id}', [ArticleController::class, 'deleteArticle'], [AuthMiddleware::class]),
    Route::post('/article/create', [ArticleController::class, 'create'], [AuthMiddleware::class]),
    Route::post('/article/update/{id}', [ArticleController::class, 'update'], [AuthMiddleware::class]),

    // -- user

    Route::get('/user/{id}', [UserController::class, 'user'], [AuthMiddleware::class]),
    Route::get('/user/settings/{id}', [UserController::class, 'settings'], [AuthMiddleware::class]),
    Route::get('/user/delete/{id}', [UserController::class, 'delete'], [AuthMiddleware::class, AdminMiddleware::class]),
    
//    Route::get('/user/settings', [UserController::class, 'settings'], [AuthMiddleware::class]),
//    Route::get('/user/edit/{id}', [UserController::class, 'settings'], [AuthMiddleware::class, AdminMiddleware::class]),
//    Route::get('/user/delete/{id}', [UserController::class, 'delete'], [AuthMiddleware::class, AdminMiddleware::class]),

    Route::post('/user/settings/updatePhoto', [UserController::class, 'updatePhoto'], [AuthMiddleware::class]),
    Route::post('/user/settings/updateSocials', [UserController::class, 'updateSocials'], [AuthMiddleware::class]),
    Route::post('/user/settings/updateProfile', [UserController::class, 'updateProfile'], [AuthMiddleware::class]),
    Route::post('/user/settings/updatePassword', [UserController::class, 'updatePassword'], [AuthMiddleware::class]),
    Route::post('/user/settings/deleteAccount', [UserController::class, 'deleteAccount'], [AuthMiddleware::class]),

    // -- admin

    Route::get('/admin/', [AdminController::class, 'index'], [AuthMiddleware::class, AdminMiddleware::class]),
    Route::get('/admin/home', [AdminController::class, 'index'], [AuthMiddleware::class, AdminMiddleware::class]),
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'], [AuthMiddleware::class, AdminMiddleware::class]),
    Route::get('/admin/list/users', [AdminController::class, 'listUsers'], [AuthMiddleware::class, AdminMiddleware::class]),
    Route::get('/admin/list/articles', [AdminController::class, 'listArticles'], [AuthMiddleware::class, AdminMiddleware::class]),
];
