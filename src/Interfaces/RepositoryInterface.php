<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Interfaces;

use Exception;
use PDOException;
use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;

interface RepositoryInterface
{
    /**
     * Retrieves entity with the given ID.
     *
     * @param int $id
     * @return EntityInterface
     * @throws StorageDataMissingException
     * @throws PDOException
     * @throws Exception
     */
    public function getById(int $id): EntityInterface;

    /**
     * Retrieves entities with the given IDs.
     *
     * @param array $ids
     * @return CollectionInterface
     * @throws StorageDataMissingException
     * @throws PDOException
     * @throws Exception
     */
    public function getByIds(array $ids): CollectionInterface;

    /**
     * Retrieves all entities.
     *
     * @return CollectionInterface
     * @throws StorageDataMissingException
     * @throws PDOException
     * @throws Exception
     */
    public function getAll(): CollectionInterface;

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
     * Updates entity with the data and provided ID.
     *
     * @param array $data
     * @param int $id
     * @return int
     * @throws PDOException
     * @throws Exception
     */
    public function update(array $data, int $id): int;

    /**
     * Deletes entity based on the ID.
     *
     * @param int $id
     * @return int
     * @throws PDOException
     * @throws Exception
     */
    public function delete(int $id): int;
}
