<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Components;

interface DatabaseInterface
{
    /**
     * @param string $query
     * @param array $params
     * @return array
     */
    public function query(string $query, array $params): array;
    public function insert(string $table, array $data): int;
    public function update(string $table, array $data, array $conditions): int;
    public function delete(string $table, array $conditions): int;
}
