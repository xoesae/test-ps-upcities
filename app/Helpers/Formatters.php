<?php

declare(strict_types=1);

namespace App\Helpers;

class Formatters
{
    public static function documentNumber(string $value): string
    {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", '$1.$2.$3-$4', $value);
    }

    public static function phoneNumber(string $value): string
    {
        $phone = preg_replace('/[^0-9]/', '', $value);
        $matches = [];
        preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $phone, $matches);

        if ($matches) {
            return sprintf('(%s) %s-%s', $matches[1], $matches[2], $matches[3]);
        }

        return $phone;
    }
}
