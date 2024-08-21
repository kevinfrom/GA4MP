<?php

namespace kevinfrom\GA4MP\Tests\Event;

use kevinfrom\GA4MP\Events\Ecom\AddToCart;
use kevinfrom\GA4MP\Events\EventItem;
use kevinfrom\GA4MP\Http\Payload;
use kevinfrom\GA4MP\Http\Response;
use kevinfrom\GA4MP\Tests\BaseTestCase;

class AddToCartEventTest extends BaseTestCase
{
    public function testAddToCartEvent(): void
    {
        $item = new EventItem(1, 'Test product');
        $this->assertInstanceOf(EventItem::class, $item);
        $this->assertEquals(1, $item->getItemId());
        $this->assertEquals('Test product', $item->getItemName());

        $item->setPrice(100);
        $this->assertEquals(100, $item->getPrice());

        $item->setIndex(0);
        $this->assertEquals(0, $item->getIndex());

        $item->setQuantity(2);
        $this->assertEquals(2, $item->getQuantity());

        $event = new AddToCart($item->getPrice() * $item->getQuantity(), 'USD');
        $this->assertInstanceOf(AddToCart::class, $event);

        $event->addItem($item);
        $this->assertInstanceOf(EventItem::class, $event->getEventParams('items')[0]);
        $this->assertCount(1, $event->getItems());

        $this->assertEquals($event->getEventParams('value'), 200);
        $this->assertEquals($event->getEventParams('currency'), 'USD');

        $this->assertFalse($event->getDebugMode());
        $event->setDebugMode(true);
        $this->assertTrue($event->getDebugMode());

        $payload = new Payload($this->getClientId(), $event);

        $response = $this->getClient()->send($payload);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertEquals($payload->getClientId(), $this->getClientId());
    }

    public function testValidateAddToCartEvent(): void
    {
        $item1 = new EventItem(1, 'Test product');
        $this->assertInstanceOf(EventItem::class, $item1);
        $this->assertEquals(1, $item1->getItemId());
        $this->assertEquals('Test product', $item1->getItemName());

        $item1->setPrice(100);
        $this->assertEquals(100, $item1->getPrice());

        $item1->setIndex(0);
        $this->assertEquals(0, $item1->getIndex());

        $item1->setQuantity(2);
        $this->assertEquals(2, $item1->getQuantity());

        $item2 = new EventItem(2, 'Test product 2');
        $this->assertInstanceOf(EventItem::class, $item2);
        $this->assertEquals(2, $item2->getItemId());
        $this->assertEquals('Test product 2', $item2->getItemName());

        $item2->setPrice(200);
        $this->assertEquals(200, $item2->getPrice());

        $item2->setIndex(1);
        $this->assertEquals(1, $item2->getIndex());

        $item2->setQuantity(3);
        $this->assertEquals(3, $item2->getQuantity());

        $value = $item1->getPrice() * $item1->getQuantity() + $item2->getPrice() * $item2->getQuantity();

        $event = new AddToCart($value, 'USD', [$item1, $item2]);
        $this->assertInstanceOf(AddToCart::class, $event);
        $this->assertCount(2, $event->getItems());

        $this->assertFalse($event->getDebugMode());
        $event->setDebugMode(true);
        $this->assertTrue($event->getDebugMode());

        $payload  = new Payload($this->getClientId(), $event);
        $response = $this->getClient()->validate($payload);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertArrayHasKey('validationMessages', $response->getData());
        $this->assertEmpty($response->getData()['validationMessages']);
    }
}
