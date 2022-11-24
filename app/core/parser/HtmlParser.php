<?php

namespace app\core\parser;

use app\core\exceptions\UnknownActionException;

class HtmlParser extends BaseParser
{
    private static function getStatesMachineRules(): array
    {
        $rules = [];

        $rules[] = StateRuleFacade::forState(StateRule::STATE_UNSET)
            ->ifChar('<')
            ->changeState(StateRule::STATE_TAG_STARTED)
            ->doAction(StateRule::ACTION_CLEAR);

        $rules[] = StateRuleFacade::forState(StateRule::STATE_TAG_STARTED)
            ->doAction(StateRule::ACTION_PUT);

        $rules[] = StateRuleFacade::forState(StateRule::STATE_TAG_STARTED)
            ->ifChar(' ')
            ->changeState(StateRule::STATE_SKIP)
            ->doAction(StateRule::ACTION_STORE);

        $rules[] = StateRuleFacade::forState(StateRule::STATE_SKIP)
            ->ifChar('>')
            ->changeState(StateRule::STATE_UNSET);

        $rules[] = StateRuleFacade::forState(StateRule::STATE_TAG_STARTED)
            ->ifChar('>')
            ->changeState(StateRule::STATE_UNSET)
            ->doAction(StateRule::ACTION_STORE);

        return $rules;
    }

    /**
     * @throws UnknownActionException
     */
    private static function getTagsListForBody(string $body): array
    {
        $stateMachine = new StateMachine(self::getStatesMachineRules());

        $position = 0;
        $bodyLength = strlen($body);
        while ($position < $bodyLength) {
            $stateMachine->putChar($body[$position]);
            $position ++;
        }

        return $stateMachine->getResult();
    }

    private static function getTagsWithCountList(array $rawInfo): array
    {
        $tagsInfo = [];
        foreach ($rawInfo as $tag) {
            $tagsInfo[$tag] = ($tagsInfo[$tag] ?? 0) + 1;
        }

        return $tagsInfo;
    }

    /**
     * @throws UnknownActionException
     */
    public static function parse($body): array
    {
        $allTagsList = self::getTagsListForBody($body);

        return self::getTagsWithCountList($allTagsList);
    }
}
