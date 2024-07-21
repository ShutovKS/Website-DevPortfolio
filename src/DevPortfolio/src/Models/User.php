<?php

namespace App\Models;

class User extends AbstractModel
{
    protected static string $table = 'users';

    public string $username;
    public string $fullName;
    public string $linkToPhoto;

    public string $email;
    public string $phone;

        public string $job;
    public string $locationCity;
    public string $locationCountry;

    public string $socialWebsite;
    public string $socialGithub;
    public string $socialVk;
    public string $socialTelegram;

    public string $passwordHash;
    public string $salt;

    public string $createdAt;
    public string $updatedAt;

    public int $isAuthor;
    public int $isAdmin;


    protected static function arrayToModel(array $data): self
    {
        $model = new self();

        $model->id = $data['id'];
        $model->username = $data['username'];
        $model->fullName = $data['full_name'];
        $model->linkToPhoto = $data['link_to_photo'];
        $model->email = $data['email'];
        $model->phone = $data['phone'];
        $model->job = $data['job'];
        $model->locationCity = $data['location_city'];
        $model->locationCountry = $data['location_country'];
        $model->socialWebsite = $data['social_website'];
        $model->socialGithub = $data['social_github'];
        $model->socialVk = $data['social_vk'];
        $model->socialTelegram = $data['social_telegram'];
        $model->passwordHash = $data['password_hash'];
        $model->salt = $data['salt'];
        $model->createdAt = $data['created_at'];
        $model->updatedAt = $data['updated_at'];
        $model->isAuthor = $data['is_author'];
        $model->isAdmin = $data['is_admin'];

        return $model;
    }

    protected function toArray(): array
    {
        return [
            'id' => $this->id ?? null,
            'username' => $this->username,
            'full_name' => $this->fullName,
            'link_to_photo' => $this->linkToPhoto,
            'email' => $this->email,
            'phone' => $this->phone,
            'job' => $this->job,
            'location_city' => $this->locationCity,
            'location_country' => $this->locationCountry,
            'social_website' => $this->socialWebsite,
            'social_github' => $this->socialGithub,
            'social_vk' => $this->socialVk,
            'social_telegram' => $this->socialTelegram,
            'password_hash' => $this->passwordHash,
            'salt' => $this->salt,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'is_author' => $this->isAuthor,
            'is_admin' => $this->isAdmin,
        ];
    }
}


