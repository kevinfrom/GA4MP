<?php

namespace kevinfrom\GA4MP\Events\Generic;

use kevinfrom\GA4MP\Events\SimpleEvent;

class Share extends SimpleEvent
{
    protected string $eventName = 'share';

    public function __construct(?string $method = null, ?string $contentType = null, ?string $itemId = null)
    {
        parent::__construct($this->eventName, array_filter([
            'method'       => $method,
            'content_type' => $contentType,
            'item_id'      => $itemId,
        ]));
    }
}