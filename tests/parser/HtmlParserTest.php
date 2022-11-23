<?php

namespace tests\parser;

use app\core\exceptions\UnknownActionException;
use app\core\parser\HtmlParser;
use tests\BaseTest;

class HtmlParserTest extends BaseTest
{
    const DEMO_CONTENT = [
        '<html lang="fu">123<b>123<c>111<d>ABC</d></c></b><b> <net>Hi</net><net>222</net></html><net'
        => ['html' => 1, 'b' => 2, 'c' => 1, 'd' => 1, 'net' => 2]
    ];

    /**
     * @throws UnknownActionException
     */
    public static function run(): bool
    {
        foreach (self::DEMO_CONTENT as $input => $correctOutput) {
            $output = HtmlParser::parse($input);
            if ($output !== $correctOutput) {
                self::outputDoesntMatch($input, $output, $correctOutput);
                return false;
            }
        }

        return true;
    }
}
