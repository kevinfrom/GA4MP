<?php

namespace kevinfrom\GA4MP\Tests\Client;

use kevinfrom\GA4MP\Data\Consent;
use kevinfrom\GA4MP\Data\UserAddress;
use kevinfrom\GA4MP\Data\UserProvidedData;
use kevinfrom\GA4MP\Tests\BaseTestCase;
use kevinfrom\GA4MP\Http\Client;
use kevinfrom\GA4MP\Http\Payload;
use kevinfrom\GA4MP\Http\Response;
use kevinfrom\GA4MP\Events\PageView;

class HttpClientTest extends BaseTestCase
{
    public function testClientInit(): void
    {
        $this->assertInstanceOf(Client::class, $this->getClient());

        $this->assertNotEmpty($this->getClient()->getApiSecret());
        $this->assertNotEmpty($this->getClient()->getMeasurementId());

        $this->assertEquals($_ENV['GA4_MP_API_SECRET'], $this->getClient()->getApiSecret());
        $this->assertEquals($_ENV['GA4_MP_MEASUREMENT_ID'], $this->getClient()->getMeasurementId());

        $this->assertNotEquals($this->getClient()->getApiSecret(), $this->getClient()->getMeasurementId());
    }

    public function testUserProvidedData(): void
    {
        $pageViewEvent = new PageView('https://www.example.com', 'home');
        $this->assertInstanceOf(PageView::class, $pageViewEvent);
        $this->assertEquals('page_view', $pageViewEvent->getEventName());
        $this->assertEquals('https://www.example.com', $pageViewEvent->getEventParams('page_location'));
        $this->assertEquals('home', $pageViewEvent->getEventParams('page_title'));

        $pageViewEvent->setDebugMode(true);
        $this->assertTrue($pageViewEvent->getDebugMode());

        $payload = new Payload($this->getClientId(), $pageViewEvent);
        $payload->setUserId('test_user_id');

        $userProvidedData = new UserProvidedData();
        $userProvidedData->addEmailAddress('john@doe.com');
        $userProvidedData->addPhoneNumber('+4511223344');
        $userProvidedData->addAddress(new UserAddress('John', 'Doe', 'Springfield', 'Main Street 123', '12345', 'US', 'IL'));

        $payload->setUserProvidedData($userProvidedData);

        $response = $this->getClient()->send($payload);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());

        $this->assertEquals('test_user_id', $payload->getUserId());

        $this->assertEquals('john@doe.com', $userProvidedData->getEmailAddresses()[0]);
        $this->assertEquals('+4511223344', $userProvidedData->getPhoneNumbers()[0]);

        $this->assertEquals('John', $userProvidedData->getAddresses()[0]->getFirstName());
        $this->assertEquals('Doe', $userProvidedData->getAddresses()[0]->getLastName());
        $this->assertEquals('Springfield', $userProvidedData->getAddresses()[0]->getCity());
        $this->assertEquals('Main Street 123', $userProvidedData->getAddresses()[0]->getStreet());
        $this->assertEquals('12345', $userProvidedData->getAddresses()[0]->getPostalCode());
        $this->assertEquals('US', $userProvidedData->getAddresses()[0]->getCountry());
        $this->assertEquals('IL', $userProvidedData->getAddresses()[0]->getRegion());
    }

    public function testConsent(): void
    {
        $pageViewEvent = new PageView('https://www.example.com', 'home');
        $this->assertInstanceOf(PageView::class, $pageViewEvent);

        $pageViewEvent->setDebugMode(true);
        $this->assertTrue($pageViewEvent->getDebugMode());

        $payload = new Payload($this->getClientId(), $pageViewEvent);
        $consent = new Consent(true, true);

        $payload->setConsent($consent);

        $response = $this->getClient()->send($payload);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());

        $this->assertTrue($payload->getConsent()->getAdUserData());
        $this->assertTrue($payload->getConsent()->getAdPersonalization());
    }
}
