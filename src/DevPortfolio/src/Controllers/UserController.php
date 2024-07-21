<?php

namespace App\Controllers;

use App\Models\Articles;
use App\Models\User;

class UserController extends AbstractController
{
    public function user($id): void
    {
        if ((int)$id === 0 && $this->identification()->isAuth()) {
            $id = $this->identification()->getUser()->id;
        }

        /** @var User $user */
        $user = User::find($id);

        if (!$user) {
            $this->redirect()->to('/error/404');
            exit();
        }

        $thisIsCurrentUser = $this->identification()->isAuth() && $this->identification()->getUser()->id === $user->id;

        /** @var Articles[] $articles */
        $articles = Articles::findByUserId($id);

        $socialsInProfile = $this->getSocialsInProfile();

        $data = $this->getData([
            'user' => $user,
            'articles' => $articles,
            'socials_in_profile' => $socialsInProfile,
            'this_is_current_user' => $thisIsCurrentUser,
        ]);

        $this->view('/user/profile', $data, 'Profile');
    }

    public function settings($id): void
    {
        if (!$this->identification()->isAuth()) {
            $this->redirect()->to('/error/404');
            exit();
        }

        if ((int)$id === 0 && $this->identification()->isAuth()) {
            $id = $this->identification()->getUser()->id;
        }

        if (!((int)$id === $this->identification()->getUser()->id) && !$this->identification()->isAdmin()) {
            $this->redirect()->to('/error/404');
            exit();
        }

        /** @var User $user */
        $user = User::find($id);

        if (!$user) {
            $this->redirect()->to('/error/404');
            exit();
        }

        $socialsInProfile = $this->getSocialsInProfile();

        $data = $this->getData([
            'user' => $user,
            'socials_in_profile' => $socialsInProfile,
        ]);

        $this->view('/user/settings', $data, 'Settings');
    }

    public function delete($id): void
    {
        if (!$this->identification()->isAuth()) {
            $this->redirect()->to('/error/404');
            exit();
        }

        if (!((int)$id === $this->identification()->getUser()->id) && !$this->identification()->isAdmin()) {
            $this->redirect()->to('/error/404');
            exit();
        }

        /** @var User $user */
        $user = User::find($id);

        if (!$user) {
            $this->redirect()->to('/error/404');
            exit();
        }

        if ($this->identification()->getUser()->id === $user->id) {
            $this->identification()->logout();
        }

        $user->delete();

        if ($this->identification()->isAdmin()) {
            $this->redirect()->to('/admin/list/users');
        } else {
            $this->redirect()->to('/');
        }
    }

    public function updatePhoto(): void
    {
        $user_id = $this->request()->input('user_id');
        $link_to_photo = $this->request()->input('link_to_photo');

        $rules = ['link_to_photo' => 'required|no_scripts|image_url:jpeg,png,jpg,gif',];

        $data = ['link_to_photo' => $link_to_photo,];

        $errors = ['updatePhoto' => $this->validator()->validate($data, $rules),];

        if (count($errors['updatePhoto']) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings/' . $user_id);
            return;
        }

        /** @var User $user */
        $user = User::find($user_id);

        if (!$user) {
            $this->redirect()->to('/error/404');
            exit();
        }

        $user->linkToPhoto = $link_to_photo;

        $user->save();

        $this->redirect()->to('/user/settings/' . $user_id);
    }

    public function updateSocials(): void
    {
        $user_id = $this->request()->input('user_id');
        $socialWebsite = $this->request()->input('website');
        $socialGithub = $this->request()->input('github');
        $socialVk = $this->request()->input('vk');
        $socialTelegram = $this->request()->input('telegram');

        $rules = [
            'website' => 'no_scripts',
            'github' => 'no_scripts',
            'vk' => 'no_scripts',
            'telegram' => 'no_scripts',
        ];

        $data = [
            'website' => $socialWebsite,
            'github' => $socialGithub,
            'vk' => $socialVk,
            'telegram' => $socialTelegram,
        ];

        $errors = ['updateSocials' => $this->validator()->validate($data, $rules),];

        if (count($errors['updateSocials']) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings/' . $user_id);
            return;
        }

        /** @var User $user */
        $user = User::find($user_id);

        if (!$user) {
            $this->redirect()->to('/error/404');
            exit();
        }

        $user->socialWebsite = $socialWebsite;
        $user->socialGithub = $socialGithub;
        $user->socialVk = $socialVk;
        $user->socialTelegram = $socialTelegram;

        $user->save();

        $this->redirect()->to('/user/settings/' . $user_id);
    }

    public function updateProfile(): void
    {
        $user_id = $this->request()->input('user_id');
        $fullName = $this->request()->input('full_name');
        $phone = $this->request()->input('phone');
        $country = $this->request()->input('country');
        $city = $this->request()->input('city');
        $job = $this->request()->input('job');

        $rules = [
            'full_name' => 'no_scripts',
            'phone' => 'no_scripts',
            'country' => 'no_scripts',
            'city' => 'no_scripts',
            'job' => 'no_scripts',
        ];

        $data = [
            'full_name' => $fullName,
            'phone' => $phone,
            'country' => $country,
            'city' => $city,
            'job' => $job,
        ];

        $errors = ['updateProfile' => $this->validator()->validate($data, $rules),];

        if (count($errors['updateProfile']) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings/' . $user_id);
            return;
        }

        /** @var User $user */
        $user = User::find($user_id);

        if (!$user) {
            $this->redirect()->to('/error/404');
            exit();
        }

        $user->fullName = $fullName;
        $user->phone = $phone;
        $user->locationCountry = $country;
        $user->locationCity = $city;
        $user->job = $job;

        $user->save();

        $this->redirect()->to('/user/settings/' . $user_id);
    }

    public function updatePassword(): void
    {
        $user_id = $this->request()->input('user_id');
        $old_password = $this->request()->input('old_password');
        $new_password = $this->request()->input('new_password');
        $new_password_confirm = $this->request()->input('new_password_confirm');

        $rules = [
            'old_password' => 'required|no_scripts',
            'new_password' => 'required|no_scripts|min:6',
            'new_password_confirm' => 'required|no_scripts|same:' . $new_password,
        ];

        $data = [
            'old_password' => $old_password,
            'new_password' => $new_password,
            'new_password_confirm' => $new_password_confirm,
        ];

        $errors = ['updatePassword' => $this->validator()->validate($data, $rules),];

        if (count($errors['updatePassword']) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings/' . $user_id);
            return;
        }

        /** @var User $user */
        $user = User::find($user_id);
        if (!$user) {
            $this->redirect()->to('/error/404');
            exit();
        }

        if (!$this->identification()->checkPassword($old_password)) {
            $errors = ['password' => ['Old password is incorrect']];
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings/' . $user_id);
            return;
        }

        $this->identification()->updatePassword($new_password);
        $user->save();

        $this->redirect()->to('/user/settings/' . $user_id);
    }

    public function deleteAccount(): void
    {
        $user_id = $this->request()->input('user_id');
        $password = $this->request()->input('password');

        $rules = ['password' => 'required|no_scripts',];

        $errors = ['deleteAccount' => $this->validator()->validate(['password' => $password,], $rules),];

        if (count($errors['deleteAccount']) > 0) {
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings/' . $user_id);
            return;
        }

        /** @var User $user */
        $user = User::find($user_id);
        if (!$user) {
            $this->redirect()->to('/error/404');
            exit();
        }

        if (!$this->identification()->checkPassword($password)) {
            $errors = ['delete' => ['Password is incorrect']];
            $this->session()->set('errors', $errors);
            $this->redirect()->to('/user/settings/' . $user_id);
            return;
        }

        $user->delete();
        $this->identification()->logout();

        $this->redirect()->to('/');
    }

    protected function getData(array $data = []): array
    {
        $data = parent::getData($data);

        return $data;
    }

    private function getSocialsInProfile()
    {
        return $this->config()->get('socialsInProfile');
    }
}