<?php

namespace kevinfrom\GA4MP\Events\Generic;

use kevinfrom\GA4MP\Events\SimpleEvent;

class Search extends SimpleEvent
{
    protected string $eventName = 'search';

    public function __construct(?string $searchTerm = null)
    {
        parent::__construct($this->eventName, array_filter([
            'search_term' => $searchTerm,
        ]));
    }
}