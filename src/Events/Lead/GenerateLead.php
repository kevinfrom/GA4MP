<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\Event;

class GenerateLead extends Event
{
    protected string $eventName = 'generate_lead';
}