<?php

namespace kevinfrom\GA4MP\Events\Generic;

use kevinfrom\GA4MP\Events\SimpleEvent;

class JoinGroup extends SimpleEvent
{
    protected string $eventName = 'join_group';

    public function __construct(?string $groupId = null)
    {
        parent::__construct($this->eventName, array_filter([
            'group_id' => $groupId,
        ]));
    }
}