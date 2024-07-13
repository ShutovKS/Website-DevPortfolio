<?php

namespace App\Kernel\Services\Database;

interface DatabaseInterface
{
    public function query(string $query, array $parameters = []): void;

    public function fetch(string $query, array $parameters = []): array;

    public function fetchAll(string $query, array $parameters = []): array;
}

