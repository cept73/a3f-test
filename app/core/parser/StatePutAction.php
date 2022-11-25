<?php

namespace app\core\parser;

class StatePutAction extends StateAction
{
    use SingletonTrait;

    public function run(StateMachine $stateMachine, string $char)
    {
        $stateMachine->addToTempString($char);
    }
}
