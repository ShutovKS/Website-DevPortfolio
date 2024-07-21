<?php

namespace App\Kernel\Services\Database;

interface DatabaseInterface
{
    public function insert(string $table, array $data): int|false;

    public function first(string $table, array $conditions = []): ?array;

    public function select(string $table, array $columns = ['*'], array $conditions = []): array;

    public function delete(string $table, array $conditions = []): bool;

    public function update(string $table, array $data, array $conditions = []): bool;

    public function query(string $query, array $params = []): array;

    public function transaction(callable $callback): bool;

    public function beginTransaction(): void;

    public function getRandomRows(string $table, int $count): array;

    public function rawQuery(string $query): array;

    public function commit(): void;

    public function rollBack(): void;
}

