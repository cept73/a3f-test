<?php

namespace app\core\exceptions;

class InputNotFoundException extends BaseException
{
    protected $code = self::CODE_INPUT_NOT_FOUND;
}
