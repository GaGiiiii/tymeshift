<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Task;

use Tymeshift\PhpTest\Exceptions\InvalidCollectionDataProvidedException;
use Tymeshift\PhpTest\Interfaces\CollectionInterface;
use Tymeshift\PhpTest\Interfaces\EntityInterface;
use Tymeshift\PhpTest\Interfaces\FactoryInterface;

class TaskFactory implements FactoryInterface
{
    public function createEntity(array $data): EntityInterface
    {
        $entity = new TaskEntity();

        if (array_key_exists('id', $data) && is_int($data['id'])) {
            $entity->setId($data['id']);
        }

        if (array_key_exists('schedule_id', $data) && is_int($data['schedule_id'])) {
            $entity->setScheduleId($data['schedule_id']);
        }

        if (array_key_exists('start_time', $data) && is_int($data['start_time'])) {
            $entity->setStartTime((new \DateTime())->setTimestamp($data['start_time']));
        }

        if (array_key_exists('duration', $data) && is_int($data['duration'])) {
            $entity->setDuration($data['duration']);
        }

        return $entity;
    }

    /**
     * @throws InvalidCollectionDataProvidedException
     */
    public function createCollection(array $data): CollectionInterface
    {
        return (new TaskCollection())->createFromArray($data, $this);
    }
}
