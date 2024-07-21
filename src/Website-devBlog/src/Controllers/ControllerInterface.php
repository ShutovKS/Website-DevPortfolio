<?php

namespace App\Controllers;

use App\Kernel\Services\Config\ConfigInterface;
use App\Kernel\Services\Database\DatabaseInterface;
use App\Kernel\Services\Http\RedirectInterface;
use App\Kernel\Services\Http\RequestInterface;
use App\Kernel\Services\Identification\IdentificationInterface;
use App\Kernel\Services\Session\SessionInterface;
use App\Kernel\Services\TextSanitizer\TextSanitizerInterface;
use App\Kernel\Services\Validator\ValidatorInterface;
use App\Kernel\Services\View\ViewInterface;

interface ControllerInterface
{
    public function view(string $name, array $data = [], string $title = ''): void;
    public function setView(ViewInterface $view): void;

    public function request(): RequestInterface;
    public function setRequest(RequestInterface $request): void;

    public function validator(): ValidatorInterface;
    public function setValidator(ValidatorInterface $validator): void;

    public function redirect(): RedirectInterface;
    public function setRedirect(RedirectInterface $redirect): void;

    public function session(): SessionInterface;
    public function setSession(SessionInterface $session): void;

    public function database(): DatabaseInterface;
    public function setDatabase(DatabaseInterface $db): void;

    public function identification(): IdentificationInterface;
    public function setIdentification(IdentificationInterface $identification): void;

    public function config(): ConfigInterface;
    public function setConfig(ConfigInterface $config): void;

    public function htmlTextSanitizer(): TextSanitizerInterface;
    public function setHtmlTextSanitizer(TextSanitizerInterface $htmlTextSanitizer): void;

}