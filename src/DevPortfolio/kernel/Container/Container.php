<?php

namespace App\Kernel\Container;

use App\Kernel\Services\Config\Config;
use App\Kernel\Services\Config\ConfigInterface;
use App\Kernel\Services\Database\DatabaseInterface;
use App\Kernel\Services\Database\DatabaseMySQL;
use App\Kernel\Services\Http\Redirect;
use App\Kernel\Services\Http\RedirectInterface;
use App\Kernel\Services\Http\Request;
use App\Kernel\Services\Http\RequestInterface;
use App\Kernel\Services\Identification\Identification;
use App\Kernel\Services\Identification\IdentificationInterface;
use App\Kernel\Services\Router\Router;
use App\Kernel\Services\Router\RouterInterface;
use App\Kernel\Services\Session\Session;
use App\Kernel\Services\Session\SessionInterface;
use App\Kernel\Services\TextSanitizer\HtmlTextSanitizer;
use App\Kernel\Services\TextSanitizer\TextSanitizerInterface;
use App\Kernel\Services\Validator\Validator;
use App\Kernel\Services\Validator\ValidatorInterface;
use App\Kernel\Services\View\View;
use App\Kernel\Services\View\ViewInterface;

class Container implements ContainerInterface
{
    private RouterInterface $router;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private ValidatorInterface $validator;
    private ViewInterface $view;
    private DatabaseInterface $database;
    private ConfigInterface $config;
    private IdentificationInterface $identification;
    private TextSanitizerInterface $htmlTextSanitizer;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->validator = new Validator();
        $this->view = new View();
        $this->config = new Config();
        $this->database = new DatabaseMySQL(
            $this->config->get('database.driver'),
            $this->config->get('database.host'),
            $this->config->get('database.port'),
            $this->config->get('database.database'),
            $this->config->get('database.username'),
            $this->config->get('database.password'),
            $this->config->get('database.charset')
        );
        $this->identification = new Identification($this->session, $this->config);
        $this->htmlTextSanitizer = new HtmlTextSanitizer();
        $this->router = new Router(
            $this->view,
            $this->request,
            $this->validator,
            $this->redirect,
            $this->session,
            $this->config,
            $this->identification,
            $this->htmlTextSanitizer
        );
    }

    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getRedirect(): RedirectInterface
    {
        return $this->redirect;
    }

    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    public function getView(): ViewInterface
    {
        return $this->view;
    }

    public function getDatabase(): DatabaseInterface
    {
        return $this->database;
    }

    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    public function getIdentification(): IdentificationInterface
    {
        return $this->identification;
    }

    public function getHtmlTextSanitizer(): TextSanitizerInterface
    {
        return $this->htmlTextSanitizer;
    }
}

