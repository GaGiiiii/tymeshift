<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Schedule;

use PDOException;
use Tymeshift\PhpTest\Components\DatabaseInterface;
use Tymeshift\PhpTest\Interfaces\EntityInterface;
use Tymeshift\PhpTest\Interfaces\StorageInterface;

class ScheduleStorage implements ScheduleStorageInterface
{
    private DatabaseInterface $db;
    private string $table = 'schedules';

    public function __construct(DatabaseInterface $database)
    {
        $this->db = $database;
    }

    public function getById(int $id): array
    {
        try {
            return $this->db->query(
                'SELECT * FROM schedules WHERE id=:id',
                [
                    "id" => $id
                ]
            );
        } catch (PDOException $e) {
            // Log to a file
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getByIds(array $ids): array
    {
        try {
            return $this->db->query('SELECT * FROM schedules WHERE id in (:ids)', $ids);
        } catch (PDOException $e) {
            // Log to a file.
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(): array
    {
        try {
            return $this->db->query('SELECT * FROM schedules', []);
        } catch (PDOException $e) {
            // Log to a file.
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(array $data, array $conditions): int
    {
        try {
            return $this->db->update($this->table, $data, $conditions);
        } catch (PDOException $e) {
            // Log to a file.
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(array $conditions): int
    {
        try {
            return $this->db->delete($this->table, $conditions);
        } catch (PDOException $e) {
            // Log to a file.
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
