<?php

namespace App\Controllers;

class IdentificationController extends AbstractController
{
    public function openLoginPage(): void
    {
        $this->view('identification/login', $this->getData(), 'Sign in');
    }

    public function loginProcessing(): void
    {
        $data = [
            'email' => $this->request()->input('email'),
            'password' => $this->request()->input('password'),
        ];

        $rules = [
            'email' => 'required|no_scripts|email',
            'password' => 'required|no_scripts|min:6',
        ];

        $errors = $this->validator()->validate($data, $rules);

        if (count($errors) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('login');
            exit;
        }

        if (!$this->identification()->exists($data['email'])) {
            $this->session()->set('errors', ['Пользователь с таким email не найден']);
            $this->redirect()->to('login');
            exit;
        }

        $user = $this->identification()->login($data['email'], $data['password']);

        if (!$user) {
            $this->session()->set('errors', ['Неверный email или пароль']);
            $this->redirect()->to('login');
            exit;
        }

        $this->identification()->setUser($user);
        $this->redirect()->to('completed');
    }

    public function openRegistrationPage(): void
    {
        $this->view('identification/register', $this->getData(), 'Sign up');
    }

    public function registrationProcessing(): void
    {
        $data = [
            'username' => $this->request()->input('username'),
            'email' => $this->request()->input('email'),
            'password' => $this->request()->input('password'),
        ];

        $rules = [
            'username' => 'required|no_scripts|min:3|max:255',
            'email' => 'required|no_scripts|email',
            'password' => 'required|no_scripts|min:6',
        ];

        $errors = $this->validator()->validate($data, $rules);

        if (count($errors) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('register');
            exit;
        }

        if ($this->identification()->exists($data['email'])) {
            $this->session()->set('errors', ['Пользователь с таким email уже существует']);
            $this->redirect()->to('register');
            exit;
        }

        $is_registered = $this->identification()->register(
            $data['username'],
            $data['email'],
            $data['password']
        );

        if (!$is_registered) {
            $this->session()->set('errors', ['Ошибка регистрации']);
            $this->redirect()->to('register');
            exit;
        }

        $user = $this->identification()->login($data['email'], $data['password']);

        if (!$user) {
            $this->session()->set('errors', ['Ошибка авторизации']);
            $this->redirect()->to('login');
            exit;
        }

        $this->identification()->setUser($user);
        $this->redirect()->to('completed');
    }

    public function logout(): void
    {
        $this->identification()->logout();
        $this->redirect()->to('../home');
    }

    public function processPasswordRecovery(): void
    {
        $this->view('identification/recover_password', $this->getData(), 'Password recovery');
    }

    public function completed(): void
    {
        $this->view('identification/completed', $this->getData(), 'Registration completed');
    }

    protected function getData(array $data = []): array
    {
        $data = parent::getData($data);

        return $data;
    }
}