<?php

namespace app\core\parser;

abstract class StateAction
{
    abstract public function run(StateMachine $stateMachine, string $char);
}
