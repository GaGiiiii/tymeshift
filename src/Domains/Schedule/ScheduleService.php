<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Schedule;

use Exception;
use PDOException;
use Tymeshift\PhpTest\Components\HttpClientInterface;
use Tymeshift\PhpTest\Domains\Task\TaskCollection;
use Tymeshift\PhpTest\Domains\Task\TaskFactory;
use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;

class ScheduleService
{
    private ScheduleRepository $scheduleRepository;
    private HttpClientInterface $httpClient;

    public function __construct(ScheduleRepository $scheduleRepository, HttpClientInterface $httpClient)
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->httpClient = $httpClient;
    }

    /**
     * Finds schedule by ID and fills schedule items array from the response data.
     *
     * @param int $scheduleId
     * @return ScheduleEntity
     * @throws StorageDataMissingException
     * @throws PDOException
     * @throws Exception
     */
    public function fillScheduleItems(int $scheduleId): ScheduleEntity
    {
        try {
            $schedule = $this->scheduleRepository->getById($scheduleId);

            $response = $this->httpClient->request('GET', "/schedules/$scheduleId/tasks");
            $taskCollection = $response;

            $schedule->setItems($taskCollection);

            return $schedule;
        } catch (StorageDataMissingException $e) {
            throw $e;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
