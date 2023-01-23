<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Interfaces;

interface StorageInterface
{
    public function getById(int $id): array;
    public function getByIds(array $ids): array;
    public function getAll(): array;
    public function update(array $data, array $conditions): int;
    public function delete(array $conditions): int;
}
