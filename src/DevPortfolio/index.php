<?php

const APP_PATH = __DIR__;

require APP_PATH . '/vendor/autoload.php';

$app = new \App\Kernel\app();
$app->run();