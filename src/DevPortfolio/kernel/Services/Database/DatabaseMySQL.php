<?php

namespace App\Kernel\Services\Database;

use PDO;
use PDOException;

class DatabaseMySQL implements DatabaseInterface
{
    private PDO $pdo;

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
        $this->pdo = new PDO("$driver:host=$host;port=$port;dbname=$database;charset=$charset",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    public function insert(string $table, array $data): int|false
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute(array_values($data))) {
            return (int)$this->pdo->lastInsertId();
        }

        return false;
    }

    public function first(string $table, array $conditions = []): ?array
    {
        $conditionString = $this->buildConditionString($conditions);
        $sql = "SELECT * FROM $table $conditionString LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_values($conditions));
        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function select(string $table, array $columns = ['*'], array $conditions = []): array
    {
        $columnString = implode(', ', $columns);
        $conditionString = $this->buildConditionString($conditions);
        $sql = "SELECT $columnString FROM $table $conditionString";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_values($conditions));

        return $stmt->fetchAll();
    }

    public function delete(string $table, array $conditions = []): bool
    {
        $conditionString = $this->buildConditionString($conditions);
        $sql = "DELETE FROM $table $conditionString";
        return $this->pdo->prepare($sql)->execute(array_values($conditions));
    }

    public function update(string $table, array $data, array $conditions = []): bool
    {
        $dataString = implode(', ', array_map(static fn($key) => "$key = ?", array_keys($data)));
        $conditionString = $this->buildConditionString($conditions);
        $sql = "UPDATE $table SET $dataString $conditionString";
        return $this->pdo->prepare($sql)->execute(array_merge(array_values($data), array_values($conditions)));
    }

    public function query(string $query, array $params = []): array
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function transaction(callable $callback): bool
    {
        try {
            $this->beginTransaction();
            $result = $callback($this);
            $this->commit();
            return $result;
        } catch (PDOException $e) {
            $this->rollBack();
            throw $e;
        }
    }

    public function beginTransaction(): void
    {
        $this->pdo->beginTransaction();
    }

    public function getRandomRows(string $table, int $count): array
    {
        $sql = "SELECT * FROM $table ORDER BY RAND() LIMIT $count";
        $result = $this->pdo->query($sql);
        return $result ? $result->fetchAll() : [];
    }

    public function rawQuery(string $query): array
    {
        $result = $this->pdo->query($query);
        return $result ? $result->fetchAll() : [];
    }

    public function commit(): void
    {
        $this->pdo->commit();
    }

    public function rollBack(): void
    {
        $this->pdo->rollBack();
    }

    private function buildConditionString(array $conditions): string
    {
        if (empty($conditions)) {
            return '';
        }

        $conditionsArray = array_map(static fn($key) => "$key = ?", array_keys($conditions));
        return 'WHERE ' . implode(' AND ', $conditionsArray);
    }
}
