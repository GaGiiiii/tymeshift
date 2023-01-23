<?php

namespace Tymeshift\PhpTest\Domains\Schedule;

use Tymeshift\PhpTest\Domains\Schedule\ScheduleStorage;
use Tymeshift\PhpTest\Domains\Task\ScheduleCollection;
use Tymeshift\PhpTest\Interfaces\EntityInterface;
use Tymeshift\PhpTest\Interfaces\FactoryInterface;
use Tymeshift\PhpTest\Interfaces\RepositoryInterface;

class ScheduleRepository implements RepositoryInterface
{
    private ScheduleStorage $storage;
    private ScheduleFactory $factory;
    private string $table = 'schedules';

    public function __construct(ScheduleStorage $storage, FactoryInterface $factory)
    {
        $this->storage = $storage;
        $this->factory = $factory;
    }

    public function getById(int $id): EntityInterface
    {
        $data = $this->storage->getById($id);

        return $this->factory->createEntity($data);
    }

    public function getByIds(array $ids): ScheduleCollection
    {
        $data = $this->storage->getByIds($ids);

        return $this->factory->createCollection($data);
    }

    public function getAll(): ScheduleCollection
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
