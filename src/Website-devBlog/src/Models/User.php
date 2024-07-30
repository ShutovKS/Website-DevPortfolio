<?php

namespace App\Models;

class User extends AbstractModel
{
    protected static string $table = 'users';

    public string $username;
    public ?string $fullName = null;
    public ?string $linkToPhoto = null;
    public string $email;
    public ?string $phone = null;
    public ?string $job = null;
    public ?string $locationCity = null;
    public ?string $locationCountry = null;

    public ?string $socialWebsite = null;
    public ?string $socialGithub = null;
    public ?string $socialVk = null;
    public ?string $socialTelegram = null;

    public string $passwordHash;
    public string $salt;
    public ?string $rememberToken = null;

    public string $createdAt;
    public string $updatedAt;

    public int $isAuthor;
    public int $isAdmin;

    protected static function arrayToModel(array $data): self
    {
        $model = new self();

        $model->id = $data['id'];
        $model->username = $data['username'] ?? null;
        $model->fullName = $data['full_name'] ?? null;
        $model->linkToPhoto = $data['link_to_photo'] ?? null;
        $model->email = $data['email'];
        $model->phone = $data['phone'] ?? null;
        $model->job = $data['job'] ?? null;
        $model->locationCity = $data['location_city'] ?? null;
        $model->locationCountry = $data['location_country'] ?? null;
        $model->socialWebsite = $data['social_website'] ?? null;
        $model->socialGithub = $data['social_github'] ?? null;
        $model->socialVk = $data['social_vk'] ?? null;
        $model->socialTelegram = $data['social_telegram'] ?? null;
        $model->passwordHash = $data['password_hash'];
        $model->salt = $data['salt'];
        $model->createdAt = $data['created_at'];
        $model->updatedAt = $data['updated_at'];
        $model->isAuthor = $data['is_author'];
        $model->isAdmin = $data['is_admin'];
        $model->rememberToken = $data['remember_token'] ?? null;

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
            'remember_token' => $this->rememberToken,
        ];
    }
}
