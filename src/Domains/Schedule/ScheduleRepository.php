<?php

namespace Tymeshift\PhpTest\Domains\Schedule;

use Exception;
use PDO;
use PDOException;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleStorage;
use Tymeshift\PhpTest\Exceptions\DataNotDeletedException;
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
