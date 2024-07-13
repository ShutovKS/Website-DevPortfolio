<?php

namespace App\Models;

class User extends AbstractModel
{
    protected static string $table = 'users';

    public string $name;
    public string $email;
    public string $password_hash;
    public string $salt;
    public string $created_at;
    public string $updated_at;
    public int $is_author;
    public int $is_admin;

    protected static function arrayToModel(array $data): self
    {
        $model = new self();

        $model->id = $data['id'];
        $model->name = $data['name'];
        $model->email = $data['email'];
        $model->password_hash = $data['password_hash'];
        $model->salt = $data['salt'];
        $model->created_at = $data['created_at'];
        $model->updated_at = $data['updated_at'];
        $model->is_author = $data['is_author'];
        $model->is_admin = $data['is_admin'];

        return $model;
    }

    protected function toArray(): array
    {
        return [
            'id' => $this->id ?? null,
            'name' => $this->name,
            'email' => $this->email,
            'password_hash' => $this->password_hash,
            'salt' => $this->salt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_author' => $this->is_author,
            'is_admin' => $this->is_admin,
        ];
    }
}


