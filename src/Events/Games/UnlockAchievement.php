<?php

namespace kevinfrom\GA4MP\Events\Games;

use kevinfrom\GA4MP\Events\SimpleEvent;

class UnlockAchievement extends SimpleEvent
{
    protected string $eventName = 'unlock_achievement';

    public function __construct(?string $achievementId)
    {
        parent::__construct($this->eventName, array_filter([
            'achievement_id' => $achievementId,
        ]));
    }
}