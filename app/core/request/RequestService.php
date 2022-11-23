<?php

namespace app\core\request;

class RequestService
{
    public static function getUrl(): ?string
    {
        return ConsoleRequest::getUrl() ?: HttpRequest::getUrl();
    }
}
