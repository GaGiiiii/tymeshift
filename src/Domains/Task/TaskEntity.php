<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Task;

use DateTime;
use Tymeshift\PhpTest\Interfaces\EntityInterface;

class TaskEntity implements EntityInterface
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var int
     */
    private int $schedule_id;

    /**
     * @var DateTime
     */
    private DateTime $startTime;

    /**
     * @var int
     */
    private int $duration;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TaskEntity
     */
    public function setId(int $id): TaskEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getScheduleId(): int
    {
        return $this->schedule_id;
    }

    /**
     * @param int $id
     * @return TaskEntity
     */
    public function setScheduleId(int $schedule_id): TaskEntity
    {
        $this->schedule_id = $schedule_id;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStartTime(): DateTime
    {
        return $this->startTime;
    }

    /**
     * @param DateTime $startTime
     * @return TaskEntity
     */
    public function setStartTime(DateTime $startTime): TaskEntity
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return TaskEntity
     */
    public function setDuration(int $duration): TaskEntity
    {
        $this->duration = $duration;

        return $this;
    }
}
