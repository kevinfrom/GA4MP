<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\SimpleEvent;

class QualifyLead extends SimpleEvent
{
    protected string $eventName = 'qualify_lead';

    public function __construct()
    {
        parent::__construct($this->eventName, []);
    }
}