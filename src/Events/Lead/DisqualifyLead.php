<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\SimpleEvent;

class DisqualifyLead extends SimpleEvent
{
    protected string $eventName = 'disqualify_lead';

    public function __construct()
    {
        parent::__construct($this->eventName, []);
    }
}