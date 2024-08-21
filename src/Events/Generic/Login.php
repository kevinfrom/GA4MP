<?php

namespace kevinfrom\GA4MP\Events\Generic;

use kevinfrom\GA4MP\Events\SimpleEvent;

class Login extends SimpleEvent
{
    protected string $eventName = 'login';

    public function __construct(?string $method = null)
    {
        parent::__construct($this->eventName, array_filter([
            'method' => $method,
        ]));
    }
}