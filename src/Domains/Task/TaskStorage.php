<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Task;

use Tymeshift\PhpTest\Components\DatabaseInterface;
use Tymeshift\PhpTest\Components\HttpClientInterface;

class TaskStorage implements TaskStorageInterface
{
    private HttpClientInterface $client;
    private DatabaseInterface $db;

    public function __construct(
        HttpClientInterface $httpClient,
        DatabaseInterface $database
    ) {
        $this->client = $httpClient;
        $this->db = $database;
    }

    public function getByScheduleId(int $schedule_id): array
    {
        return $this->db->query(
            'SELECT * FROM schedules WHERE schedule_id=:schedule_id',
            [
                "schedule_id" => $schedule_id
            ]
        );
    }

    public function getById(int $id): array
    {
        return $this->db->query(
            'SELECT * FROM schedules WHERE id=:id',
            [
                "id" => $id
            ]
        );
    }

    public function getByIds(array $ids): array
    {
        return $this->db->query('SELECT * FROM schedules WHERE id in (:ids)', $ids);
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM schedules', []);
    }

    public function update(string $table, array $data, array $conditions): int
    {
        return $this->db->update($table, $data, $conditions);
    }

    public function delete(string $table, array $conditions): int
    {
        return $this->db->delete($table, $conditions);
    }
}
