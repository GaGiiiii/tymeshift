<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Interfaces;

use PDOException;

interface StorageInterface
{
    /**
     * Retrieves entity with the given ID as array.
     *
     * @param int $id
     * @return array
     * @throws PDOException
     * @throws Exception
     */
    public function getById(int $id): array;

    /**
     * Retrieves entities with the given IDs as array.
     *
     * @param array $ids
     * @return array
     * @throws PDOException
     * @throws Exception
     */
    public function getByIds(array $ids): array;

    /**
     * Retrieves all entities as array.
     *
     * @return array
     * @throws PDOException
     * @throws Exception
     */
    public function getAll(): array;

    /**
     * Creates new entity.
     *
     * @param array $data
     * @return int
     * @throws PDOException
     * @throws Exception
     */
    public function insert(array $data): int;

    /**
     * Updates from the array data based on the conditions.
     *
     * @param array $data
     * @param array $conditions
     * @return int
     * @throws PDOException
     * @throws Exception
     */
    public function update(array $data, array $conditions): int;

    /**
     * Delete based on conditions.
     *
     * @param array $conditions
     * @return int
     * @throws PDOException
     * @throws Exception
     */
    public function delete(array $conditions): int;
}
