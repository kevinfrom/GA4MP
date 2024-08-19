<?php

namespace kevinfrom\GA4MP\Events;

class PageView extends Event
{
    public function __construct(string $pageLocation, string $pageTitle, array $rawParams = [])
    {
        parent::__construct('page_view', array_merge($rawParams, [
            'page_location' => $pageLocation,
            'page_title'    => $pageTitle,
        ]));
    }
}
