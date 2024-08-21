<?php

namespace kevinfrom\GA4MP\Tests\Event;

use kevinfrom\GA4MP\Events\Generic\PageView;
use kevinfrom\GA4MP\Http\Payload;
use kevinfrom\GA4MP\Http\Response;
use kevinfrom\GA4MP\Tests\BaseTestCase;

class PageViewEventTest extends BaseTestCase
{
    public function testPageViewEvent(): void
    {
        $pageViewEvent = new PageView('https://www.example.com', 'home');
        $this->assertInstanceOf(PageView::class, $pageViewEvent);
        $this->assertEquals('page_view', $pageViewEvent->getEventName());
        $this->assertEquals('https://www.example.com', $pageViewEvent->getEventParams('page_location'));
        $this->assertEquals('home', $pageViewEvent->getEventParams('page_title'));

        $this->assertFalse($pageViewEvent->getDebugMode());
        $pageViewEvent->setDebugMode(true);
        $this->assertTrue($pageViewEvent->getDebugMode());

        $payload = new Payload($this->getClientId(), $pageViewEvent);

        $response = $this->getClient()->send($payload);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());
    }

    public function testValidatePageViewEvent(): void
    {
        $pageViewEvent = new PageView('https://www.example.com', 'home');

        $this->assertInstanceOf(PageView::class, $pageViewEvent);
        $this->assertEquals('page_view', $pageViewEvent->getEventName());
        $this->assertEquals('https://www.example.com', $pageViewEvent->getEventParams('page_location'));
        $this->assertEquals('home', $pageViewEvent->getEventParams('page_title'));

        $payload = new Payload($this->getClientId(), $pageViewEvent);

        $response = $this->getClient()->validate($payload);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertArrayHasKey('validationMessages', $response->getData());
        $this->assertEmpty($response->getData()['validationMessages']);
    }
}