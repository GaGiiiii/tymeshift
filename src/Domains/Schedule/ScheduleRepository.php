<?php

namespace Tymeshift\PhpTest\Domains\Schedule;

use Exception;
use PDO;
use PDOException;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleStorage;
use Tymeshift\PhpTest\Exceptions\DataNotDeletedException;
use Tymeshift\PhpTest\Exceptions\DataNotInsertedException;
use Tymeshift\PhpTest\Exceptions\DataNotUpdatedException;
use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;
use Tymeshift\PhpTest\Interfaces\EntityInterface;
use Tymeshift\PhpTest\Interfaces\FactoryInterface;
use Tymeshift\PhpTest\Interfaces\RepositoryInterface;

class ScheduleRepository implements RepositoryInterface
{
    private ScheduleStorage $storage;
    private ScheduleFactory $factory;

    public function __construct(ScheduleStorage $storage, FactoryInterface $factory)
    {
        $this->storage = $storage;
        $this->factory = $factory;
    }

    /**
     * Retrieves entity with the given ID.
     *
     * @param int $id
     * @return EntityInterface
     * @throws StorageDataMissingException
     * @throws PDOException
     * @throws Exception
     */
    public function getById(int $id): EntityInterface
    {
        try {
            $data = $this->storage->getById($id);
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        if (empty($data)) {
            throw new StorageDataMissingException();
        }

        return $this->factory->createEntity($data);
    }


    /**
     * Retrieves entities with the given IDs.
     *
     * @param array $ids
     * @return CollectionInterface
     * @throws StorageDataMissingException
     * @throws PDOException
     * @throws Exception
     */
    public function getByIds(array $ids): ScheduleCollection
    {
        try {
            $data = $this->storage->getByIds($ids);
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        if (empty($data)) {
            throw new StorageDataMissingException();
        }

        return $this->factory->createCollection($data);
    }

    /**
     * Retrieves all entities.
     *
     * @return CollectionInterface
     * @throws StorageDataMissingException
     * @throws PDOException
     * @throws Exception
     */
    public function getAll(): ScheduleCollection
    {
        try {
            $data = $this->storage->getAll();
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        if (empty($data)) {
            throw new StorageDataMissingException();
        }

        return $this->factory->createCollection($data);
    }

    /**
     * Creates new entity.
     *
     * @param array $data
     * @return int
     * @throws PDOException
     * @throws Exception
     */
    public function insert(array $data): int
    {
        try {
            $lastInsertId = $this->storage->insert($data);
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        if ($lastInsertId === null) {
            throw new DataNotInsertedException('Insert failed.');
        }

        return $lastInsertId;
    }

    /**
     * Updates entity with the data and provided ID.
     *
     * @param array $data
     * @param int $id
     * @return int
     * @throws PDOException
     * @throws Exception
     */
    public function update(array $data, int $id): int
    {
        try {
            $rowsUpdated = $this->storage->update($data, [
                'id' => $id
            ]);
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        if ($rowsUpdated === 0 || $rowsUpdated === -1) {
            throw new DataNotUpdatedException('Update failed for the schedule with the ID: ' . $id);
        }

        return $rowsUpdated;
    }

    /**
     * Deletes entity based on the ID.
     *
     * @param int $id
     * @return int
     * @throws PDOException
     * @throws Exception
     */
    public function delete(int $id): int
    {
        try {
            $rowsUpdated = $this->storage->delete([
                'id' => $id
            ]);
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        if ($rowsUpdated === 0 || $rowsUpdated === -1) {
            throw new DataNotDeletedException('Delete failed for the schedule with the ID: ' . $id);
        }

        return $rowsUpdated;
    }
}
