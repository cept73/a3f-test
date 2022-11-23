<?php

namespace app\core\exceptions;

class UnknownActionException extends BaseException
{
    protected $code = self::CODE_ACTION_UNKNOWN;
}
