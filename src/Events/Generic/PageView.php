<?php

namespace kevinfrom\GA4MP\Events\Generic;

use kevinfrom\GA4MP\Events\SimpleEvent;

class PageView extends SimpleEvent
{
    public function __construct(string $pageLocation, string $pageTitle, array $rawParams = [])
    {
        parent::__construct('page_view', array_merge($rawParams, [
            'page_location' => $pageLocation,
            'page_title'    => $pageTitle,
        ]));
    }
}
