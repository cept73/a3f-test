<?php

namespace app\core\parser;

class StateClearAction extends StateAction
{
    use SingletonTrait;

    public function run(StateMachine $stateMachine, string $char)
    {
        $stateMachine->clearTempString();
    }
}
