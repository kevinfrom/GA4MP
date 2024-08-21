<?php

namespace kevinfrom\GA4MP\Events\Ecom;

use kevinfrom\GA4MP\Events\Event;

class RemoveFromCart extends Event
{
    protected string $eventName = 'remove_from_cart';
}
