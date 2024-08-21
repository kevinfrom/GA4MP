<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\SimpleEvent;

class CloseUnconvertedLead extends SimpleEvent
{
    protected string $eventName = 'close_unconverted_lead';

    public function __construct()
    {
        parent::__construct($this->eventName, []);
    }
}