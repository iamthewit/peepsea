<?php

namespace Factory;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class PeepSeaIdFactory
{
    /**
     * @return UuidInterface
     */
    public static function generate(): UuidInterface
    {
        return Uuid::uuid4();
    }
}