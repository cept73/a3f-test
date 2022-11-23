<?php

namespace app\core\helpers;

class StringHelper
{
    public static function isAlphaNumeric(string $string): bool
    {
        return ctype_alnum($string);
    }
}
