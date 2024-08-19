<?php

namespace kevinfrom\GA4MP\Events\Ecom;

use kevinfrom\GA4MP\Events\Event;

abstract class EcomEvent extends Event
{
    /**
     * @param float                                   $value
     * @param string                                  $currency
     * @param \kevinfrom\GA4MP\Events\Ecom\EcomItem[] $items
     * @param array                                   $rawParams
     */
    public function __construct(float $value, string $currency, array $items = [], array $rawParams = [])
    {
        parent::__construct($this->eventName, array_merge($rawParams, [
            'value'    => $value,
            'currency' => $currency,
            'items'    => array_map(function (EcomItem $item) {
                return $item->formatData();
            }, $items),
        ]));
    }
    /**
     * Get ecommerce items
     *
     * @return \kevinfrom\GA4MP\Events\Ecom\EcomItem[]
     */
    public function getItems(): array
    {
        return $this->getEventParams('items');
    }

    /**
     * Add ecommerce item
     *
     * @param \kevinfrom\GA4MP\Events\Ecom\EcomItem $item
     *
     * @return $this
     */
    public function addItem(EcomItem $item): self
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
