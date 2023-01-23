<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Interfaces;

interface StorageInterface
{
    /**
     * Retrieves entity with the given ID.
     *
     * @param int $id
     * @return array
     */
    public function getById(int $id): array;

    /**
     * Retrieves entities with the given IDs.
     *
     * @param array $ids
     * @return array
     */
    public function getByIds(array $ids): array;

    /**
     * Retrieves all entities.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Updatesfrom the array data based on the conditions.
     *
     * @param array $data
     * @param array $conditions
     * @return int
     */
    public function update(array $data, array $conditions): int;

    /**
     * Delete based on conditions.
     *
     * @param array $conditions
     * @return int
     */
    public function delete(array $conditions): int;
}
