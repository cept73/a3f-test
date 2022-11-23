<?php

namespace app\core\parser;

use app\core\exceptions\UnknownActionException;

class StateMachine
{
    private string $tempString   = '';
    private array $result        = [];
    private ?int $currentState   = StateRule::STATE_UNSET;

    public function __construct(private array $stateRules)
    {
    }

    /**
     * @throws UnknownActionException
     */
    private function executeAction($action, $char): void
    {
        switch ($action) {
            case StateRule::ACTION_PUT:
                $this->tempString .= $char;
                break;

            /** @noinspection PhpMissingBreakStatementInspection */
            case StateRule::ACTION_STORE:
                $tag = $this->removeBrackets($this->tempString);
                if (!str_starts_with($tag, '/')) {
                    $this->result[] = $tag;
                }

            case StateRule::ACTION_CLEAR:
                $this->tempString = '';
                break;

            default:
                throw new UnknownActionException($action);
        }
    }

    private function removeBrackets(string $string): string
    {
        return substr($string, 1, -1);
    }

    /**
     * @throws UnknownActionException
     */
    public function putChar($char): void
    {
        /** @var StateRule $stateRule */
        foreach ($this->stateRules as $stateRule) {
            $forState   = $stateRule->getForState();
            $forChar    = $stateRule->getForChar();
            $newState   = $stateRule->getNewState();
            $doAction   = $stateRule->getAction();

            if ($forState !== null && $this->currentState !== $forState) {
                continue;
            }
            if ($forChar !== null && $char !== $forChar) {
                continue;
            }

            if ($newState !== null) {
                $this->currentState = $newState;
            }
            if ($doAction !== null) {
                $this->executeAction($doAction, $char);
            }
        }
    }

    public function getResult(): array
    {
        return $this->result;
    }
}
