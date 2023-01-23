<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Components;

interface DatabaseInterface
{
    /**
     * Executes query with given params and returns fetched data.
     *
     * @param string $query
     * @param array @params
     * @return array
     */
    public function query(string $query, array $params): array;

    /**
     * Inserts given data to provided table.
     *
     * @param string $table
     * @param array @data
     * @return int Last inserted ID.
     */
    public function insert(string $table, array $data): int;

    /**
     * Updates data from selected table based on provided conditions.
     *
     * @param string $table
     * @param array $conditions
     * @return int Number of rows affected.
     */
    public function update(string $table, array $data, array $conditions): int;

    /**
     * Deletes data from selected table based on provided conditions.
     *
     * @param string $table
     * @param array $conditions
     * @return int Number of rows affected.
     */
    public function delete(string $table, array $conditions): int;
}
