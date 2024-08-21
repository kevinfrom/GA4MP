<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\SimpleEvent;

class GenerateLead extends SimpleEvent
{
    protected string $eventName = 'generate_lead';

    public function __construct()
    {
        parent::__construct($this->eventName, []);
    }
}