<?php

namespace app\core\request;

abstract class BaseRequest
{
    abstract public static function getUrl(): ?string;
}
