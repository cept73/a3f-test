<?php

namespace app\core\parser;

trait SingletonTrait
{
    private static ?self $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): static
    {
        if (self::$instance == null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
