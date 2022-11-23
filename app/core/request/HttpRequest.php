<?php

namespace app\core\request;

class HttpRequest extends BaseRequest
{
    public static function getUrl(): ?string
    {
        return $_REQUEST['url'] ?? null;
    }
}
