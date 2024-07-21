<?php

use App\Kernel\app;

define("APP_PATH", dirname(__DIR__));

require APP_PATH . '/vendor/autoload.php';

$app = new app();
$app->run();