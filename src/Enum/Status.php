<?php
namespace App\Enum;

use UnitEnum;

enum Status: string {
    case draft = 'draft';
    case published = 'published';

    public static function getCases(): array
    {
        $cases = self::cases();
        return array_map(static fn(UnitEnum $case) => $case->name, $cases);
    }

    public static function getValues(): array
    {
        $cases = self::cases();
        return array_map(static fn(UnitEnum $case) => $case->value, $cases);
    }
}