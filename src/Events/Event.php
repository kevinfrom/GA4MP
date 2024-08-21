<?php

namespace kevinfrom\GA4MP\Events;

abstract class Event extends SimpleEvent
{
    /**
     * @param float                               $value
     * @param string                              $currency
     * @param \kevinfrom\GA4MP\Events\EventItem[] $items
     * @param array                               $rawParams
     */
    public function __construct(float $value, string $currency, array $items = [], array $rawParams = [])
    {
        parent::__construct($this->eventName, array_merge($rawParams, [
            'value'    => $value ? round($value, 2) : null,
            'currency' => $currency,
            'items'    => array_map(function (EventItem $item) {
                return $item->formatData();
            }, $items),
        ]));
    }
    /**
     * Get ecommerce items
     *
     * @return \kevinfrom\GA4MP\Events\EventItem[]
     */
    public function getItems(): array
    {
        return $this->getEventParams('items');
    }

    /**
     * Add ecommerce item
     *
     * @param \kevinfrom\GA4MP\Events\EventItem $item
     *
     * @return $this
     */
    public function addItem(EventItem $item): self
    {
        $params = $this->getEventParams();

        if (!isset($params['items'])) {
            $params['items'] = [];
        }

        $params['items'][] = $item;

        $this->setEventParams($params);

        return $this;
    }
}
