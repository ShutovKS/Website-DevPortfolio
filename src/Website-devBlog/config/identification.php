<?php

return [
    'table' => 'users',
    'email' => 'email',
    'username' => 'username',
    'password' => 'password',
    'session_field' => 'user_id',

    'cookie_name' => 'remember_me',
    'cookie_lifetime' => 60 * 60 * 24 * 30, // 30 days
    'cookie_path' => '/',
    'cookie_domain' => '',
    'cookie_secure' => false,
    'cookie_httponly' => true,
];