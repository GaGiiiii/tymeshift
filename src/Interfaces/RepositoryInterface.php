<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Interfaces;

interface RepositoryInterface
{
    public function getById(int $id): EntityInterface;
    public function getByIds(array $ids): CollectionInterface;
    public function getAll(): CollectionInterface;
    public function update(array $data, int $id): EntityInterface;
    public function delete(int $id): EntityInterface;
}
