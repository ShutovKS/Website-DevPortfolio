<?php

namespace App\Models;

use App\Kernel\App;
use App\Kernel\Services\Database\DatabaseInterface;

abstract class AbstractModel
{
    public int $id;
    protected static string $table;

    protected function getDatabase(): DatabaseInterface
    {
        return App::getInstance()->getContainer()->getDatabase();
    }

    public static function all(): array
    {
        $instance = new static();
        return $instance->getDatabase()->select(static::$table);
    }

    public static function find(int $id): ?self
    {
        $instance = new static();
        $result = $instance->getDatabase()->first(static::$table, ['id' => $id]);
        return $result ? new static($result) : null;
    }

    public static function where(array $conditions): array|false
    {
        $instance = new static();
        $results = $instance->getDatabase()->select(static::$table, ['*'], $conditions);

        $models = [];
        foreach ($results as $result) {
            $models[] = static::arrayToModel($result);
        }

        return $models;
    }

    public function save(): bool
    {
        unset($id);

        $data = $this->toArray();

        if (isset($this->id)) {
            return $this->getDatabase()->update(static::$table, $data, ['id' => $this->id]);
        }

        $id = $this->getDatabase()->insert(static::$table, $data);
        if ($id !== false) {
            $this->id = $id;
            return true;
        }
        return false;
    }

    public function delete(): bool
    {
        if (isset($this->id)) {
            return $this->getDatabase()->delete(static::$table, ['id' => $this->id]);
        }
        return false;
    }

    abstract protected static function arrayToModel(array $data): self;

    abstract protected function toArray(): array;
}