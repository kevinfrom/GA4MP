<?php

namespace kevinfrom\GA4MP\Events\Ecom;

use kevinfrom\GA4MP\Events\Event;

class BeginCheckout extends Event
{
    protected string $eventName = 'begin_checkout';
}
