<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Task;

use Tymeshift\PhpTest\Exceptions\DataNotInsertedException;
use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;
use Tymeshift\PhpTest\Interfaces\CollectionInterface;
use Tymeshift\PhpTest\Interfaces\EntityInterface;
use Tymeshift\PhpTest\Interfaces\RepositoryInterface;

class TaskRepository implements RepositoryInterface
{
    private TaskFactory $factory;
    private TaskStorage $storage;

    public function __construct(TaskStorage $storage, TaskFactory $factory)
    {
        $this->factory = $factory;
        $this->storage = $storage;
    }

    /**
     * Retrieves entities with the given SCHEDULE_ID.
     *
     * @param int $scheduleId
     * @return TaskCollection
     * @throws StorageDataMissingException
     * @throws PDOException
     * @throws Exception
     */
    public function getByScheduleId(int $scheduleId): TaskCollection
    {
        try {
            $data = $this->storage->getByScheduleId($scheduleId);
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
    public function getByIds(array $ids): TaskCollection
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
    public function getAll(): TaskCollection
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
            throw new DataNotUpdatedException('Update failed for the task with the ID: ' . $id);
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
            throw new DataNotDeletedException('Delete failed for the task with the ID: ' . $id);
        }

        return $rowsUpdated;
    }
}
