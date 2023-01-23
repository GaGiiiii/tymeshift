<?php

declare(strict_types=1);

namespace Tymeshift\PhpTest\Exceptions;

class StorageDataMissingException extends \Exception
{
    protected const MESSAGE = 'Storage data is missing';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, 500);
    }
}
