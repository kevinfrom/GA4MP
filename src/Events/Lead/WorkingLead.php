<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\SimpleEvent;

class WorkingLead extends SimpleEvent
{
    protected string $eventName = 'working_lead';

    public function __construct()
    {
        parent::__construct($this->eventName, []);
    }
}