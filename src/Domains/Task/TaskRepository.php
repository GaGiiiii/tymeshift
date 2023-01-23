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
    private string $table = 'tasks';

    public function __construct(TaskStorage $storage, TaskFactory $factory)
    {
        $this->factory = $factory;
        $this->storage = $storage;
    }

    public function getByScheduleId(int $scheduleId): TaskCollection
    {
        $data = $this->storage->getByScheduleId($scheduleId);

        if (empty($data)) {
            throw new StorageDataMissingException();
        }

        return $this->factory->createCollection($data);
    }

    public function getById(int $id): EntityInterface
    {
        $data = $this->storage->getById($id);

        return $this->factory->createEntity($data);
    }

    public function getByIds(array $ids): TaskCollection
    {
        $data = $this->storage->getByIds($ids);

        return $this->factory->createCollection($data);
    }

    public function getAll(): TaskCollection
    {
        $data = $this->storage->getAll();

        return $this->factory->createCollection($data);
    }

    public function update(array $data, int $id): int
    {
        $rowsUpdated = $this->storage->update($this->table, $data, [
            'id' => $id
        ]);

        return $rowsUpdated;
    }

    public function delete(int $id): int
    {
        $rowsUpdated = $this->storage->delete($this->table, [
            'id' => $id
        ]);

        return $rowsUpdated;
    }
}
