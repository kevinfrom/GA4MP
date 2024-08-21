<?php

namespace kevinfrom\GA4MP\Events\Games;

use kevinfrom\GA4MP\Events\SimpleEvent;

class SpendVirtualCurrency extends SimpleEvent
{
    protected string $eventName = 'spend_virtual_currency';

    public function __construct(?float $value, ?string $virtualCurrencyName, ?string $itemName)
    {
        parent::__construct($this->eventName, array_filter([
            'value'                 => $value ? round($value, 2) : null,
            'virtual_currency_name' => $virtualCurrencyName,
            'item_name'             => $itemName,
        ]));
    }
}