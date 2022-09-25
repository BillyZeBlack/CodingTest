<?php

namespace App\DoctrineType;

use App\Enum\Channel;
use App\DoctrineType\AbstractEnumType;

class ChannelType extends AbstractEnumType
{
    public const NAME = 'channel';
    
    public static function getEnumsClass(): string
    {
        return Channel::class;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
