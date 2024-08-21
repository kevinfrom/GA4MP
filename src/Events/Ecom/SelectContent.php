<?php

namespace kevinfrom\GA4MP\Events\Ecom;

use kevinfrom\GA4MP\Events\SimpleEvent;

class SelectContent extends SimpleEvent
{
    protected string $eventName = 'select_content';

    public function __construct(?string $contentType, ?string $contentId)
    {
        parent::__construct($this->eventName, array_filter([
            'content_type' => $contentType,
            'content_id'   => $contentId,
        ]));
    }
}