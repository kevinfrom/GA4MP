<?php

namespace kevinfrom\GA4MP\Events\Games;

use kevinfrom\GA4MP\Events\SimpleEvent;

class EarnVirtualCurrency extends SimpleEvent
{
    protected string $eventName = 'earn_virtual_currency';

    public function __construct(?string $virtualCurrencyName = null, ?float $value = null)
    {
        parent::__construct($this->eventName, array_filter([
            'virtual_currency_name' => $virtualCurrencyName,
            'value'                 => $value ? round($value, 2) : null,
        ]));
    }
}