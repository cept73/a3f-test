<?php

namespace app\core\parser;

class StateMachine
{
    private string $tempString   = '';
    private array $result        = [];
    private ?int $currentState   = StateRule::STATE_UNSET;

    public function __construct(private array $stateRules)
    {
    }

    public function removeBrackets(string $string): string
    {
        return substr($string, 1, -1);
    }

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
            $doAction?->run($this, $char);
        }
    }

    public function clearTempString(): void
    {
        $this->tempString = '';
    }

    public function addToTempString($char): void
    {
        $this->tempString .= $char;
    }

    public function getTempString(): string
    {
        return $this->tempString;
    }

    public function addResult($result): void
    {
        $this->result[] = $result;
    }

    public function getResult(): array
    {
        return $this->result;
    }
}
