<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Components;

class Database implements DatabaseInterface
{
    private PDO $pdo;

    public function __construct(string $host, string $username, string $password)
    {
        $this->pdo = new PDO($host, $username, $password);
    }

    public function query(string $query, array $params): array
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);

        return $statement->fetchAll();
    }

    public function insert(string $table, array $data): int
    {
        $columns = implode(',', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $statement = $this->pdo->prepare($query);
        $statement->execute($data);

        return $this->pdo->lastInsertId();
    }

    public function update(string $table, array $data, array $conditions): int
    {
        $set = [];

        foreach ($data as $column => $value) {
            $set[] = "$column = :$column";
        }

        $set = implode(', ', $set);

        $where = [];

        foreach ($conditions as $column => $value) {
            $where[] = "$column = :$column";
        }

        $where = implode(' AND ', $where);

        $query = "UPDATE $table SET $set WHERE $where";
        $params = array_merge($data, $conditions);
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);

        return $statement->rowCount();
    }

    public function delete(string $table, array $conditions): int
    {
        $where = [];

        foreach ($conditions as $column => $value) {
            $where[] = "$column = :$column";
        }

        $where = implode(' AND ', $where);

        $query = "DELETE FROM $table WHERE $where";
        $statement = $this->pdo->prepare($query);
        $statement->execute($conditions);

        return $statement->rowCount();
    }
}
