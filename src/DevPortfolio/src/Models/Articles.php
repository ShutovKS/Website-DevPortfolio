<?php

namespace App\Models;

class Articles extends AbstractModel
{
    protected static string $table = 'articles';

    public int $userId;
    public string $title;
    public string $content;
    public string $createdAt;
    public string $updatedAt;
    public int $published;

    protected static function arrayToModel(array $data): self
    {
        $model = new self();

        $model->id = $data['id'];
        $model->userId = $data['user_id'];
        $model->title = $data['title'];
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
            'content' => $this->content,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'published' => $this->published,
        ];
    }
}