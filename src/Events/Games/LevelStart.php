<?php

namespace kevinfrom\GA4MP\Events\Games;

use kevinfrom\GA4MP\Events\SimpleEvent;

class LevelStart extends SimpleEvent
{
    protected string $eventName = 'level_start';

    public function __construct(?string $levelName)
    {
        parent::__construct($this->eventName, array_filter([
            'level_name' => $levelName,
        ]));
    }
}