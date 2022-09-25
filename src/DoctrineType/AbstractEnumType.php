<?php

namespace App\DoctrineType;

use BackedEnum;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Symfony\Component\Validator\Exception\LogicException;

abstract class AbstractEnumType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'TEXT';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if($value instanceof BackedEnum) {
            return $value->value;
        }
        return null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if(false === enum_exists($this::getEnumsClass(), true)) {
            throw new LogicException("This class should be an enum");
        }

        return $this::getEnumsClass()::tryFrom($value);
    }

    abstract public static function getEnumsClass(): string;
}