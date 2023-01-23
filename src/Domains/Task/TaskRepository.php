<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Task;

use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;
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
