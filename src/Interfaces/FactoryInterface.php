<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Interfaces;

interface FactoryInterface
{
    /**
     * Creates entity from the array data.
     *
     * @param array $data
     * @return EntityInterface
     */
    public function createEntity(array $data): EntityInterface;

    /**
     * Creates a collection of entities from the array data.
     *
     * @param array $data
     * @return CollectionInterface
     */
    public function createCollection(array $data): CollectionInterface;
}
