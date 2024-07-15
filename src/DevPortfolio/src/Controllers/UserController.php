<?php

namespace App\Controllers;

class UserController extends AbstractController
{
    public function index(): void
    {
        $profileData = $this->getProfileData();
        $data = [
            'user' => $profileData['user'],
            'isAuthor' => $profileData['isAuthor'],
            'isAdmin' => $profileData['isAdmin'],
        ];

        $this->view('user/profile',
            $data,
            'Profile');
    }

    public function settings(): void
    {
        $profileData = $this->getProfileData();
        $data = [
            'user' => $profileData['user'],
            'isAuthor' => $profileData['isAuthor'],
            'isAdmin' => $profileData['isAdmin'],
        ];

        $this->view(
            'user/settings',
            $data,
            'Settings');
    }

    private function getProfileData(): array
    {
        $user = $this->identification()->getUser();

        if (!$user) {
            echo "<h1>User not found</h1>";
            return [];
        }

        return [
            'user' => $user,
            'isAuthor' => $user->isAuthor,
            'isAdmin' => $user->isAdmin,
        ];
    }
}