<?php

namespace app\core\parser;

class StateStoreAction extends StateAction
{
    use SingletonTrait;

    public function run(StateMachine $stateMachine, string $char)
    {
        $tag = $stateMachine->removeBrackets($stateMachine->getTempString());
        if (!str_starts_with($tag, '/')) {
            $stateMachine->addResult($tag);
        }

        $stateMachine->addToTempString($char);
    }
}
