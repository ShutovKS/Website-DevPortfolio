<?php

use App\Controllers\HomeController;
use App\Router\Route;

return [
    Route::get('/home', [HomeController:: class, 'index']),

];