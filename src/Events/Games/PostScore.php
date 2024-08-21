<?php

namespace kevinfrom\GA4MP\Events\Games;

use kevinfrom\GA4MP\Events\SimpleEvent;

class PostScore extends SimpleEvent
{
    protected string $eventName = 'post_score';

    public function __construct(?int $score, ?int $level, ?string $character)
    {
        parent::__construct($this->eventName, array_filter([
            'score'     => $score,
            'level'     => $level,
            'character' => $character,
        ]));
    }
}