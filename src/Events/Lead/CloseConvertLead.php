<?php

namespace kevinfrom\GA4MP\Events\Lead;

use kevinfrom\GA4MP\Events\SimpleEvent;

class CloseConvertLead extends SimpleEvent
{
    protected string $eventName = 'close_convert_lead';

    public function __construct()
    {
        parent::__construct($this->eventName, []);
    }
}