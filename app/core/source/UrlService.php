<?php

namespace app\core\source;

class UrlService
{
    public static function get($url): ?string
    {
        $return = @file_get_contents($url);

        return $return !== false ? $return : null;
    }
}
