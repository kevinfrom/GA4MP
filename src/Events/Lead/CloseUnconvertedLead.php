<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\Event;

class CloseUnconvertedLead extends Event
{
    protected string $eventName = 'close_unconverted_lead';
}