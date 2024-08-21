<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\Event;

class DisqualifyLead extends Event
{
    protected string $eventName = 'disqualify_lead';
}