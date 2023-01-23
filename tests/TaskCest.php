<?php

declare(strict_types=1);

namespace Tests;

use Codeception\Example;
use Tymeshift\PhpTest\Domains\Task\TaskCollection;
use Tymeshift\PhpTest\Domains\Task\TaskFactory;
use Tymeshift\PhpTest\Domains\Task\TaskRepository;
use Tymeshift\PhpTest\Domains\Task\TaskStorage;
use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;

class TaskCest
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var MockInterface|TaskStorage
     */
    private $taskStorageMock;

    public function _before()
    {
        $this->taskStorageMock = \Mockery::mock(TaskStorage::class);
        $this->taskRepository = new TaskRepository($this->taskStorageMock, new TaskFactory());
    }

    public function _after()
    {
        $this->taskStorageMock = null;
        $this->taskRepository = null;
        \Mockery::close();
    }

    /**
     * @dataProvider tasksDataProvider
     */
    public function testGetTasks(Example $example, \UnitTester $tester)
    {
        $arr = [];

        foreach ($example as $task) {
            $arr[] = $task;
        }

        $this->taskStorageMock
            ->shouldReceive('getByScheduleId')
            ->with(1)
            ->andReturn($arr);

        $tasks = $this->taskRepository->getByScheduleId(1);
        $tester->assertInstanceOf(TaskCollection::class, $tasks);
        $tester->assertCount(3, $tasks);
    }

    public function testGetTasksFailed(\UnitTester $tester)
    {
        $this->taskStorageMock
            ->shouldReceive('getByScheduleId')
            ->with(1)
            ->andReturn([]);

        $tester->expectThrowable(StorageDataMissingException::class, function () {
            $this->taskRepository->getByScheduleId(1);
        });
    }

    public function tasksDataProvider()
    {
        return [
            [
                ["id" => 123, "schedule_id" => 1, "start_time" => 0, "duration" => 3600],
                ["id" => 431, "schedule_id" => 1, "start_time" => 3600, "duration" => 650],
                ["id" => 332, "schedule_id" => 1, "start_time" => 5600, "duration" => 3600],
            ]
        ];
    }
}
