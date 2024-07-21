<?php

namespace App\Kernel\Services\Cookie;

use App\Kernel\Services\Http\Request;

readonly class Cookie implements CookieInterface
{
    public function __construct(
        private Request $request
    )
    {
    }

    public function setCookie(
        string $name,
        string $value,
        int    $expire = 3600,
        string $path = '/',
        string $domain = '',
        bool   $secure = false,
        bool   $httponly = true
    ): void
    {
        setcookie($name, $value, time() + $expire, $path, $domain, $secure, $httponly);
    }

    public function getCookie(string $name): ?string
    {
        return $this->request->cookie($name);
    }

    public function deleteCookie(
        string $name,
        string $path = '/',
        string $domain = '',
        bool   $secure = false,
        bool   $httponly = true
    ): void
    {
        setcookie($name, '', time() - 3600, $path, $domain, $secure, $httponly);
        unset($_COOKIE[$name]);
    }
}

