<?php

namespace App\Controllers;

class UserController extends AbstractController
{
    public function index(): void
    {
        $this->view('user/profile', [], 'Profile');
    }

    public function settings(): void
    {
        $data = [
            'user' => [
                'name' => 'johndoe',

                'photo' => 'https://bootdey.com/img/Content/avatar/avatar7.png',
                'fullName' => 'John Doe',
                'job' => 'Web Developer',
                'location_city' => 'New York',
                'location_country' => 'USA',

                'email' => 'example@mail.com',
                'phone' => '+1234567890',
                'password' => '********',
            ],
            'socials' => [
                'website' => 'https://example.com',
                'github' => 'https://github.com',
                'vk' => 'https://vk.com',
                'telegram' => 'https://t.me'
            ],
        ];

        $this->view(
            'user/settings',
            $data,
            'Settings');
    }

}