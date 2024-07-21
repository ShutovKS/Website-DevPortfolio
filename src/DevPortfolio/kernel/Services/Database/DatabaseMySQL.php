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

        try {
            $this->pdo = new PDO("$driver:host=$host;port=$port;dbname=$database;charset=$charset",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );

            $this->checkingAvailabilityTables();
        } catch (PDOException) {

        }
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

    private function checkingAvailabilityTables(): void
    {
        $tables = $this->pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
        if (!in_array('users', $tables, true)) {
            $this->pdo->query("
CREATE TABLE `users`
(
    `id`               int UNSIGNED NOT NULL,
    `username`         varchar(255) NOT NULL,
    `full_name`        varchar(255)          DEFAULT NULL,
    `link_to_photo`    varchar(255)          DEFAULT NULL,
    `email`            varchar(255) NOT NULL,
    `phone`            varchar(20)           DEFAULT NULL,
    `job`              varchar(255)          DEFAULT NULL,
    `location_city`    varchar(255)          DEFAULT NULL,
    `location_country` varchar(255)          DEFAULT NULL,
    `social_website`   varchar(255)          DEFAULT NULL,
    `social_github`    varchar(255)          DEFAULT NULL,
    `social_vk`        varchar(255)          DEFAULT NULL,
    `social_telegram`  varchar(255)          DEFAULT NULL,
    `password_hash`    varchar(255) NOT NULL,
    `salt`             varchar(32)  NOT NULL,
    `remember_token`   varchar(255)          DEFAULT NULL,
    `created_at`       timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`       timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `is_author`        tinyint(1)   NOT NULL DEFAULT '1',
    `is_admin`         tinyint(1)   NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `users` (`id`, `username`, `full_name`, `link_to_photo`, `email`, `phone`, `job`, 
                     `is_author`, `is_admin`, `password_hash`, `salt`)
VALUES (1, 'admin', 'Main admin', 'https://github.githubassets.com/assets/pull-shark-default-498c279a747d.png',
        'admin@mail.com', '345-678-9012', 'Admin', 1, 1,
        'b1bf4e915954747316564d958a501a693528e7cc5360fdd9efa33b487f2c7345', 'bec8ac4a0227e26acbd2ccf63af6eb56');

ALTER TABLE `users` 
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email` (`email`),
    ADD UNIQUE KEY `phone` (`phone`);

ALTER TABLE `users`
    MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

COMMIT;
");
        }

        if (!in_array('articles', $tables, true)) {
            $this->pdo->query("
CREATE TABLE `articles`
(
    `id`          int UNSIGNED NOT NULL,
    `user_id`     int UNSIGNED NOT NULL,
    `title`       varchar(255) NOT NULL,
    `description` text,
    `content`     text         NOT NULL,
    `created_at`  timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `published`   tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

ALTER TABLE `articles`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`);

ALTER TABLE `articles`
    MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `articles`
    ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;
");
        }
    }
}
