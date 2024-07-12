<?php

use App\Router\Route;

return [
    Route::get('/home', static function () {
        include_once APP_PATH . '/views/pages/home.php';
    }),
];