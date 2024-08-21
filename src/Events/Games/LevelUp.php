<?php

namespace kevinfrom\GA4MP\Events\Games;

use kevinfrom\GA4MP\Events\SimpleEvent;

class LevelUp extends SimpleEvent
{
    protected string $eventName = 'level_up';

    public function __construct(?int $level, ?string $character)
    {
        parent::__construct($this->eventName, array_filter([
            'level'     => $level,
            'character' => $character,
        ]));
    }
}