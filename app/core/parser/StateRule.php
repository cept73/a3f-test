<?php

namespace app\core\parser;

class StateRule
{
    public const STATE_UNSET        = 0;
    public const STATE_TAG_STARTED  = 1;
    public const STATE_SKIP         = 2;

    public const ACTION_PUT         = 0;
    public const ACTION_CLEAR       = 1;
    public const ACTION_STORE       = 2;

    private ?string $_char          = null;
    private ?int $_forState         = null;
    private ?int $_newState         = null;
    private ?int $_action           = null;

    public function ifChar(string $char): static
    {
        $this->_char = $char[0];
        return $this;
    }

    public function forState($state): static
    {
        $this->_forState = $state;
        return $this;
    }

    public function changeState($state): static
    {
        $this->_newState = $state;
        return $this;
    }

    public function doAction($action): static
    {
        $this->_action = $action;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getForChar(): ?string
    {
        return $this->_char;
    }

    /**
     * @return int|null
     */
    public function getForState(): ?int
    {
        return $this->_forState;
    }

    /**
     * @return int|null
     */
    public function getNewState(): ?int
    {
        return $this->_newState;
    }

    /**
     * @return int|null
     */
    public function getAction(): ?int
    {
        return $this->_action;
    }
}
