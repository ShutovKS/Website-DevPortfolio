<?php

namespace App\Controllers;

class IdentificationController extends AbstractController
{
    public function open_login_page(): void
    {
        $errors = $this->session()->get('errors');
        $this->session()->remove('errors');

        $this->view('identification/login', ['errors' => $errors], 'Sign in');
    }

    public function login_processing(): void
    {
        $data = [
            'email' => $this->request()->input('email'),
            'password' => $this->request()->input('password'),
        ];

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
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
    }

    public function open_registration_page(): void
    {
        $errors = $this->session()->get('errors');
        $this->session()->remove('errors');

        $this->view(
            'identification/register',
            ['errors' => $errors],
            'Sign up'
        );
    }

    public function registration_processing(): void
    {
        $data = [
            'username' => $this->request()->input('username'),
            'email' => $this->request()->input('email'),
            'password' => $this->request()->input('password'),
        ];

        $rules = [
            'username' => 'required|min:3|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
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

        $this->redirect()->to('login');
    }
}