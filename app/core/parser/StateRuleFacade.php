<?php

namespace app\core\parser;

class StateRuleFacade
{
    public static function forState($state): StateRule
    {
        return (new StateRule())->forState($state);
    }
}
