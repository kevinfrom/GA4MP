<?php

namespace kevinfrom\GA4MP\Events\Games;

use kevinfrom\GA4MP\Events\SimpleEvent;

class TutorialComplete extends SimpleEvent
{
    protected string $eventName = 'tutorial_complete';

    public function __construct()
    {
        parent::__construct($this->eventName, []);
    }
}
