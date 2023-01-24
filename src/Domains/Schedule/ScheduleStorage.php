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

    /**
     * Retrieves entity with the given ID as array.
     *
     * @param int $id
     * @return array
     * @throws PDOException
     * @throws Exception
     */
    public function getById(int $id): array
    {
        try {
            return $this->db->query(
                "SELECT * FROM {$this->table} WHERE id=:id",
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

    /**
     * Retrieves entities with the given IDs as array.
     *
     * @param array $ids
     * @return array
     * @throws PDOException
     * @throws Exception
     */
    public function getByIds(array $ids): array
    {
        try {
            return $this->db->query("SELECT * FROM {$this->table} WHERE id in (:ids)", $ids);
        } catch (PDOException $e) {
            // Log to a file.
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Retrieves all entities as array.
     *
     * @return array
     * @throws PDOException
     * @throws Exception
     */
    public function getAll(): array
    {
        try {
            return $this->db->query("SELECT * FROM {$this->table}", []);
        } catch (PDOException $e) {
            // Log to a file.
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates new entity.
     *
     * @param array $data
     * @return int
     * @throws PDOException
     * @throws Exception
     */
    public function insert(array $data): int
    {
        try {
            return $this->db->insert($this->table, $data);
        } catch (PDOException $e) {
            // Log to a file.
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Updates from the array data based on the conditions.
     *
     * @param array $data
     * @param array $conditions
     * @return int
     * @throws PDOException
     * @throws Exception
     */
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

    /**
     * Delete based on conditions.
     *
     * @param array $conditions
     * @return int
     * @throws PDOException
     * @throws Exception
     */
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
