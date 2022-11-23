<?php

namespace app\core\view;

abstract class BaseView
{
    abstract public static function render(string $templateName, array $data): string;
}
