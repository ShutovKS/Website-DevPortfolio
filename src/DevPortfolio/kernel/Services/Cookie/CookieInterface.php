<?php

namespace App\Kernel\Services\Cookie;

interface CookieInterface
{
    /**
     * Установить cookie.
     *
     * @param string $name Имя cookie.
     * @param string $value Значение cookie.
     * @param int $expire Время жизни cookie в секундах (по умолчанию - 1 час).
     * @param string $path Путь на сервере, для которого доступен cookie.
     * @param string $domain Домен, для которого доступен cookie.
     * @param bool $secure Передавать cookie только по HTTPS.
     * @param bool $httponly Сделать cookie доступным только через HTTP-протокол.
     * @return void
     */
    public function setCookie(
        string $name,
        string $value,
        int    $expire = 3600,
        string $path = '/',
        string $domain = '',
        bool   $secure = false,
        bool   $httponly = true
    ): void;

    /**
     * Получить значение cookie.
     *
     * @param string $name Имя cookie.
     * @return string|null Значение cookie или null, если cookie не найден.
     */
    public function getCookie(string $name): ?string;

    /**
     * Удалить cookie.
     *
     * @param string $name Имя cookie.
     * @param string $path Путь на сервере, для которого доступен cookie.
     * @param string $domain Домен, для которого доступен cookie.
     * @param bool $secure Передавать cookie только по HTTPS.
     * @param bool $httponly Сделать cookie доступным только через HTTP-протокол.
     * @return void
     */
    public function deleteCookie(
        string $name,
        string $path = '/',
        string $domain = '',
        bool   $secure = false,
        bool   $httponly = true
    ): void;
}