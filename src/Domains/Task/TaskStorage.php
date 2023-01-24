<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Task;

use Tymeshift\PhpTest\Components\DatabaseInterface;
use Tymeshift\PhpTest\Components\HttpClientInterface;

class TaskStorage implements TaskStorageInterface
{
    private HttpClientInterface $client;
    private DatabaseInterface $db;
    private string $table = 'tasks';

    public function __construct(
        HttpClientInterface $httpClient,
        DatabaseInterface $database
    ) {
        $this->client = $httpClient;
        $this->db = $database;
    }

    /**
     * Retrieves entity with the given scheduleId as array.
     *
     * @param int $id
     * @return array
     */
    public function getByScheduleId(int $schedule_id): array
    {
        try {
            return $this->db->query(
                "SELECT * FROM {$this->table} WHERE schedule_id=:schedule_id",
                [
                    "schedule_id" => $schedule_id
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
     * Retrieves entity with the given ID as array.
     *
     * @param int $id
     * @return array
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
     */
    public function getByIds(array $ids): array
    {
        try {
            return $this->db->query("SELECT * FROM {$this->table} WHERE id in (:ids)", $ids);
        } catch (PDOException $e) {
            // Log to a file
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Retrieves all entities as array.
     *
     * @return array
     */
    public function getAll(): array
    {
        try {
            return $this->db->query("SELECT * FROM {$this->table}", []);
        } catch (PDOException $e) {
            // Log to a file
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
     */
    public function update(array $data, array $conditions): int
    {
        try {
            return $this->db->update($this->table, $data, $conditions);
        } catch (PDOException $e) {
            // Log to a file
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
     */
    public function delete(array $conditions): int
    {
        try {
            return $this->db->delete($this->table, $conditions);
        } catch (PDOException $e) {
            // Log to a file
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
