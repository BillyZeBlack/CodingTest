<?php

namespace App\DoctrineType;

use App\Enum\Status;
use App\DoctrineType\AbstractEnumType;

class StatusType extends AbstractEnumType
{
    public const NAME = 'status';
    
    public static function getEnumsClass(): string
    {
        return Status::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
