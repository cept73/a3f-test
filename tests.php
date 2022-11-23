<?php

use tests\BaseTest;
use tests\parser\HtmlParserTest;
require 'vendor/autoload.php';

$testsClassList = [
    HtmlParserTest::class,
];

/** @var BaseTest $testClass */
foreach ($testsClassList as $testClass) {
    $success = $testClass::run();
    if ($success) {
        print "[+] $testClass success\n";
    } else {
        print "[-] $testClass failed\n";
    }
}
