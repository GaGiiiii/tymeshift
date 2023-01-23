<?php

namespace Tymeshift\PhpTest\Domains\Schedule;

use Tymeshift\PhpTest\Domains\Task\ScheduleCollection;
use Tymeshift\PhpTest\Interfaces\CollectionInterface;
use Tymeshift\PhpTest\Interfaces\EntityInterface;
use Tymeshift\PhpTest\Interfaces\FactoryInterface;

class ScheduleFactory implements FactoryInterface
{
    public function createEntity(array $data): EntityInterface
    {
        $entity = new ScheduleEntity();

        if (array_key_exists('id', $data) && is_int($data['id'])) {
            $entity->setId($data['id']);
        }

        if (array_key_exists('start_time', $data) && is_int($data['start_time'])) {
            $entity->setStartTime((new \DateTime())->setTimestamp($data['start_time']));
        }

        if (array_key_exists('end_time', $data) && is_int($data['end_time'])) {
            $entity->setEndTime((new \DateTime())->setTimestamp($data['end_time']));
        }

        if (array_key_exists('name', $data) && is_string($data['name'])) {
            $entity->setName($data['name']);
        }

        return $entity;
    }

    public function createCollection(array $data): CollectionInterface
    {
        return (new ScheduleCollection())->createFromArray($data, $this);
    }
}
