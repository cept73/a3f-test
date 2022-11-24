<?php

namespace tests;

abstract class BaseTest
{
    abstract public static function run(): bool;

    public static function outputDoesntMatch($input, $output, $correctOutput): void
    {
        print_r(['[!] ERROR: OUTPUT DOES NOT MATCH', $input, $output, $correctOutput]);
    }
}
