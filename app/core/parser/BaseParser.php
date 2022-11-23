<?php

namespace app\core\parser;

abstract class BaseParser
{
    abstract public static function parse($body);
}
