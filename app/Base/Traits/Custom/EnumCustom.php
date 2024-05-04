<?php

namespace App\Base\Traits\Custom;

trait EnumCustom
{
    public static function casesValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function __callStatic($method, $args)
    {
        $enumValue = (string) str($method)->snake();

        if (!in_array($enumValue, self::casesValues())) {
            throw new \Exception('Function Not Found In Enum Class', 422);
        }

        return $enumValue;
    }

    public static function keysAndValues(): array
    {
        $cases = self::cases();
        $values = array_column($cases, 'value');
        return array_combine($values, $values);
    }
}
