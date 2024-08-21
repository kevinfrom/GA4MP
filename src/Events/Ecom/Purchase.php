<?php

namespace kevinfrom\GA4MP\Events\Ecom;

use kevinfrom\GA4MP\Events\Event;

class Purchase extends Event
{
    protected string $eventName = 'purchase';
}
