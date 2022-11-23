<?php

namespace tests;

abstract class BaseTest
{
    abstract public static function run(): bool;

    public static function outputDoesntMatch($input, $output, $correctOutput)
    {
        print_r(['[!] ERROR: OUTPUT DOESN\'T MATCH', $input, $output, $correctOutput]);
    }
}
