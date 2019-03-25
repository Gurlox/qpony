<?php

namespace App\Test;

class EOL
{
    public static function stringWithEOL(string $string): string
    {
        return str_replace(' ', PHP_EOL, $string);
    }
}
