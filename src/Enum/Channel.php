<?php
namespace App\Enum;

use UnitEnum;

enum Channel: string {
    case faq = 'faq';
    case bot = 'bot';

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