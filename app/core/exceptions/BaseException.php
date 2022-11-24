<?php

namespace app\core\exceptions;

use Exception;

abstract class BaseException extends Exception
{
    public const CODE_INPUT_NOT_FOUND       = 100;
    public const CODE_TEMPLATE_NOT_FOUND    = 101;
    public const CODE_ACTION_UNKNOWN        = 102;
}
