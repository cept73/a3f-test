<?php

namespace app\core\exceptions;

class TemplateNotFoundException extends BaseException
{
    protected $code = self::CODE_TEMPLATE_NOT_FOUND;
}
