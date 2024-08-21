<?php

namespace kevinfrom\GA4MP\Events\Generic;

use kevinfrom\GA4MP\Events\SimpleEvent;

class SignUp extends SimpleEvent
{
    protected string $eventName = 'sign_up';

    public function __construct(?string $method = null)
    {
        parent::__construct($this->eventName, array_filter([
            'method' => $method,
        ]));
    }
}