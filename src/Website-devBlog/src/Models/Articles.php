<?php

namespace App\Models;

class Articles extends AbstractModel
{
    protected static string $table = 'articles';

    public int $userId;
    public string $title;
    public ?string $description;
    public string $content;
    public string $createdAt;
    public string $updatedAt;
    public int $published;

    public static function findByUserId(int $user_id): array
    {
        return self::where(['user_id' => $user_id]);
    }

    protected static function arrayToModel(array $data): self
    {
        $model = new self();

        $model->id = $data['id'];
        $model->userId = $data['user_id'];
        $model->title = $data['title'];
        $model->description = $data['description'];
        $model->content = $data['content'];
        $model->createdAt = $data['created_at'];
        $model->updatedAt = $data['updated_at'];
        $model->published = $data['published'];

        return $model;
    }

    protected function toArray(): array
    {
        return [
            'id' => $this->id ?? null,
            'user_id' => $this->userId,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'published' => $this->published,
        ];
    }
}