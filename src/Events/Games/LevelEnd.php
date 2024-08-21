<?php

namespace kevinfrom\GA4MP\Events\Games;

use kevinfrom\GA4MP\Events\SimpleEvent;

class LevelEnd extends SimpleEvent
{
    protected string $eventName = 'level_end';

    public function __construct(?string $levelName, ?bool $success = null)
    {
        parent::__construct($this->eventName, array_filter([
            'level_name' => $levelName,
            'success'    => $success,
        ]));
    }
}