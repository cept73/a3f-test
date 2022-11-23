<?php

namespace app\core\request;

class ConsoleRequest extends BaseRequest
{
    public static function getUrl(): ?string
    {
        return $_SERVER['argv'][1] ?? null;
    }
}
