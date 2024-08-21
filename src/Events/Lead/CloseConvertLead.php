<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\Event;

class CloseConvertLead extends Event
{
    protected string $eventName = 'close_convert_lead';
}