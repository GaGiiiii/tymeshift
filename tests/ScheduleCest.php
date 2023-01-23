<?php

declare(strict_types=1);

namespace Tests;

use Codeception\Example;
use Mockery\MockInterface;
use Tymeshift\PhpTest\Components\HttpClient;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleRepository;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleFactory;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleService;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleStorage;
use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;

class ScheduleCest
{
    private $scheduleStorageMock;
    private $httpClientMock;
    private $scheduleRepository;

    public function _before()
    {
        $this->httpClientMock = \Mockery::mock(HttpClient::class);
        $this->scheduleStorageMock = \Mockery::mock(ScheduleStorage::class);
        $this->scheduleRepository = new ScheduleRepository($this->scheduleStorageMock, new ScheduleFactory());
    }

    public function _after()
    {
        $this->scheduleRepository = null;
        $this->httpClientMock = null;
        $this->scheduleStorageMock = null;
        \Mockery::close();
    }

    /**
     * @dataProvider scheduleProvider
     */
    public function testGetByIdSuccess(Example $example, \UnitTester $tester)
    {
        ['id' => $id, 'start_time' => $startTime, 'end_time' => $endTime, 'name' => $name] = $example;

        $this->scheduleStorageMock
            ->shouldReceive('getById')
            ->with($id)
            ->andReturn(['id' => $id, 'start_time' => $startTime, 'end_time' => $endTime, 'name' => $name]);

        $entity = $this->scheduleRepository->getById($id);

        $tester->assertEquals($id, $entity->getId());
        $tester->assertEquals($startTime, $entity->getStartTime()->getTimestamp());
        $tester->assertEquals($endTime, $entity->getEndTime()->getTimestamp());
        $tester->assertEquals($name, $entity->getName());
    }

    /**
     * @param \UnitTester $tester
     */
    public function testGetByIdFail(\UnitTester $tester)
    {
        $this->scheduleStorageMock
            ->shouldReceive('getById')
            ->with(4)
            ->andReturn([]);

        $tester->expectThrowable(StorageDataMissingException::class, function () {
            $this->scheduleRepository->getById(4);
        });
    }

    /**
     * @dataProvider scheduleProvider
     */
    public function testFillScheduleItems(Example $example, \UnitTester $tester)
    {
        // Set expectations for the getScheduleById method
        ['id' => $id, 'start_time' => $startTime, 'end_time' => $endTime, 'name' => $name] = $example;

        // Set expectations for the get method
        $taskCollection = [
            ["id" => 1, "schedule_id" => 1, 'duration' => 3000, 'start_time' => 1631232000],
            ["id" => 2, "schedule_id" => 1, 'duration' => 3600, 'start_time' => 1631232000],
        ];

        $this->scheduleStorageMock
            ->shouldReceive('getById')
            ->with($id)
            ->andReturn(['id' => $id, 'start_time' => $startTime, 'end_time' => $endTime, 'name' => $name]);

        $this->httpClientMock
            ->shouldReceive('request')
            ->with('GET', "/schedules/$id/tasks")
            ->andReturn($taskCollection);

        // Create an instance of the ScheduleService
        $scheduleService = new ScheduleService($this->scheduleRepository, $this->httpClientMock);

        // Call the fillScheduleItems method
        $schedule = $scheduleService->fillScheduleItems(1);

        // Assert that the ScheduleEntity::$items property is filled with the tasks from the TaskCollection
        $tester->assertEquals($taskCollection, $schedule->getItems());
    }

    /**
     * @return array[]
     */
    protected function scheduleProvider()
    {
        return [
            ['id' => 1, 'start_time' => 1631232000, 'end_time' => 1631232000 + 86400, 'name' => 'Test'],
        ];
    }
}
