<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Schedule;

use Tymeshift\PhpTest\Components\DatabaseInterface;
use Tymeshift\PhpTest\Interfaces\EntityInterface;
use Tymeshift\PhpTest\Interfaces\StorageInterface;

class ScheduleStorage implements ScheduleStorageInterface
{
    /**
     * @var DatabaseInterface
     */
    private DatabaseInterface $db;

    public function __construct(DatabaseInterface $database)
    {
        $this->db = $database;
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
