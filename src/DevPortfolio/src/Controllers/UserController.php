<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends AbstractController
{
    public function index(): void
    {
        $data = $this->getData();

        $this->view('user/profile',
            $data,
            'Profile');
    }

    public function settings(): void
    {
        $data = $this->getData();

        $this->view(
            'user/settings',
            $data,
            'Settings');
    }

    public function updatePhoto(): void
    {
        $photo = $this->request()->input('photo');

        $rules = [
            'photo' => 'required|image_url:jpeg,png,jpg,gif',
        ];

        $errors = [
            'photo' => $this->validator()->validate([
                'photo' => $photo,
            ], $rules),
        ];

        if (count($errors['photo']) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings');
            return;
        }

        /** @var User $userData */
        $userData = User::find($this->identification()->getUser()->id);
        $userData->linkToPhoto = $photo;

        $userData->save();

        $this->redirect()->to('/user/settings');
    }

    public function updateSocials(): void
    {
        /** @var User $userData */
        $userData = User::find($this->identification()->getUser()->id);
        $userData->socialWebsite = $this->request()->input('website');
        $userData->socialGithub = $this->request()->input('github');
        $userData->socialVk = $this->request()->input('vk');
        $userData->socialTelegram = $this->request()->input('telegram');

        $userData->save();

        $this->redirect()->to('/user/settings');
    }

    public function updateProfile(): void
    {
        /** @var User $userData */
        $userData = User::find($this->identification()->getUser()->id);
        $userData->fullName = $this->request()->input('fullName');
        $userData->phone = $this->request()->input('phone');
        $userData->locationCountry = $this->request()->input('country');
        $userData->locationCity = $this->request()->input('city');
        $userData->job = $this->request()->input('job');

        $userData->save();

        $this->redirect()->to('/user/settings');
    }

    public function updatePassword(): void
    {
        $oldPassword = $this->request()->input('oldPassword');
        $newPassword = $this->request()->input('newPassword');
        $confirmPassword = $this->request()->input('confirmPassword');

        $rules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6',
        ];

        $errors = [
            'password' => $this->validator()->validate([
                'oldPassword' => $oldPassword,
                'newPassword' => $newPassword,
                'confirmPassword' => $confirmPassword,
            ], $rules),
        ];

        if (count($errors['password']) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings');
            return;
        }

        if (!$this->identification()->checkPassword($oldPassword)) {
            $errors = ['password' => ['Old password is incorrect']];
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings');
            return;
        }

        if ($newPassword !== $confirmPassword) {
            $errors = ['password' => ['Passwords do not match']];
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings');
            return;
        }

        $this->identification()->updatePassword($newPassword);
        $this->identification()->logout();
        $this->view('/identification/login', [], 'Login');
    }

    public function deleteAccount(): void
    {
        $password = $this->request()->input('password');

        $rules = [
            'password' => 'required',
        ];

        $errors = [
            'delete' => $this->validator()->validate([
                'password' => $password,
            ], $rules),
        ];

        if (count($errors['delete']) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings');
            return;
        }

        if (!$this->identification()->checkPassword($password)) {
            $errors = ['delete' => ['Password is incorrect']];
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings');
            return;
        }

        $this->identification()->getUser()->delete();
        $this->identification()->logout();

        $this->view('/identification/register', [], 'Register');
    }

    private function getData(): array
    {
        $user = $this->identification()->getUser();
        $errors = $this->session()->get('errors');
        $this->session()->remove('errors');

        return [
            'user' => $user,
            'isAuthor' => $user->isAuthor,
            'isAdmin' => $user->isAdmin,
            'errors' => $errors,
            'socialsInProfile' => $this->getSocialsInProfileConfig(),
        ];
    }

    private function getSocialsInProfileConfig()
    {
        return $this->config()->get('socialsInProfile');
    }
}