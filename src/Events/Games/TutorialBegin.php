<?php

namespace kevinfrom\GA4MP\Events\Games;

use kevinfrom\GA4MP\Events\SimpleEvent;

class TutorialBegin extends SimpleEvent
{
    protected string $eventName = 'tutorial_begin';
}
