<?php

namespace App\Kernel\Services\Database;

use PDO;

class DatabaseMySQL implements DatabaseInterface
{
    private PDO $connection;

    public function __construct(
        string $driver,
        string $host,
        string $port,
        string $database,
        string $username,
        string $password,
        string $charset,
    )
    {
        $this->connection = new PDO("$driver:host=$host;port=$port;dbname=$database;charset=$charset",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    public function query(string $query, array $parameters = []): void
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($parameters);
    }

    public function fetch(string $query, array $parameters = []): array
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($parameters);
        return $statement->fetch();
    }

    public function fetchAll(string $query, array $parameters = []): array
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($parameters);
        return $statement->fetchAll();
    }
}