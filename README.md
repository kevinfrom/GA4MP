# GA4MP

A PHP library for Google Analytics 4 Measurement Protocol. Ensures type-safety and provides a fluent interface for tracking using the Measurement Protocol API.

## Introduction

This library is a PHP implementation of the Google Analytics 4 Measurement Protocol. It provides a fluent interface for tracking events, user properties, and user
interactions. The library ensures type-safety and provides a simple way to send data to the Measurement Protocol API.

By using classes to represent events, user properties, and user interactions, the library ensures that the data sent to the API is valid and correctly formatted. This reduces
the risk of errors and makes it easier to track events and user interactions.

It also makes it very easy to track events and user interactions by providing a simple and intuitive API. You can create events, user properties, and user interactions using
simple classes and methods, and then send the data to the API with a single method call, and multiple events can be sent for the same user in a single request!

## Example: `sign_up`

This example shows how to track a `sign_up` event.

```php
<?php

use kevinfrom\GA4MP\Events\Generic\SignUp;
use kevinfrom\GA4MP\Http\Payload;
use kevinfrom\GA4MP\Http\Client;


$signupEvent = new Signup();

// The client ID should be read from the "_ga" cookie set by GA4. Note that php does not have access to the cookies set by GA4.
$clientId = '123456789.1234567890';
$payload = new Payload($clientId, $signupEvent)

// The API secret can be created in the GA4 interface.
$apiSecret = '[API_SECRET]';
// The measurement ID can be read from the GA4 interface. 
$measurementId = 'G-xxxxxxxx';
$client = new Client($apiSecret, $measurementId);

// You should validate the payload before sending it to the API.
$validateResponse = $client->validate($payload);
if ($validateResponse->isOk()) {
    $response = $client->send($payload);
    
    if ($response->isOk() === false) {
        // Handle API errors
        $errors = $response->getData();
        // ...
    }
} else {
    // Handle validation errors
    $errors = $validateResponse->getData();
    // ...
}

```

## Event items

Some events, like `add_to_cart`, `purchase`, and `view_item`, require additional items to be sent with the event. The library provides classes to represent these items and
ensures that the data sent to the API is valid and correctly formatted.

For example, to track a `purchase` event with a list of items, you can use the `Purchase` and `EventItem` classes:

```php
<?php

use kevinfrom\GA4MP\Events\EventItem;
use kevinfrom\GA4MP\Events\Ecom\Purchase;
use kevinfrom\GA4MP\Http\Payload;
use kevinfrom\GA4MP\Http\Client;

$itemId = 'tshirt-1';
$itemName = 'White t-shirt';
$eventItem = new EventItem($itemId, $itemName);

// You can set additional properties for the item using setters
$eventItem->setItemCategory('Apparel');
$eventItem->setQuantity(3);
$eventItem->setPrice(49.95);
$eventItem->setItemVariant('White');

$value = $eventItem->getPrice() * $eventItem->getQuantity();
$currency = 'USD';
$purchaseEvent = new Purchase($value, $currency, [$eventItem]);

$payload = new Payload($clientId, $purchaseEvent)

$client = new Client($apiSecret, $measurementId);

$validateResponse = $client->validate($payload);
if ($validateResponse->isOk()) {
    $response = $client->send($payload);
    
    if ($response->isOk() === false) {
        // Handle API errors
        $errors = $response->getData();
        // ...
    }
} else {
    // Handle validation errors
    $errors = $validateResponse->getData();
    // ...
}

```

## Consent, User address and user provided data

The library also provides classes to represent user properties, user address, and consent information. These classes can be used to send additional information about the user.

```php
<?php

use kevinfrom\GA4MP\Data\Consent;
use kevinfrom\GA4MP\Data\UserProvidedData;
use kevinfrom\GA4MP\Data\UserAddress;
use kevinfrom\GA4MP\Events\Ecom\Purchase;
use kevinfrom\GA4MP\Events\EventItem;
use kevinfrom\GA4MP\Http\Payload;
use kevinfrom\GA4MP\Http\Client;

$payload = new Payload($clientId, $purchaseEvent);

// Create a Consent object and set ad user data and ad personalization
$adUserData = true;
$adPersonalization = true;
$consent = new Consent($adUserData, $adPersonalization);

$payload->setConsent($consent);

// Create a UserProvidedData object and add user provided data
$userProvidedData = new UserProvidedData();
$userProvidedData->addEmailAddress('john@doe.com');
$userProvidedData->addPhoneNumber('+1234567890');
$userAddress = new UserAddress();
$userAddress->setCountry('DK');
$userAddress->setCity('Copenhagen');
$userAddress->setPostalCode('2300');
$userProvidedData->setAddress($userAddress);

// Now set the user provided data on the payload
$payload->setUserProvidedData($userProvidedData);

$validateResponse = $client->validate($payload);
if ($validateResponse->isOk()) {
    $response = $client->send($payload);
    
    if ($response->isOk() === false) {
        // Handle API errors
        $errors = $response->getData();
        // ...
    }
} else {
    // Handle validation errors
    $errors = $validateResponse->getData();
    // ...
}

```

## Hashing user provided data

The library automatically hashed some user provided data according to the Measurement Protocol documentation

Please do not try to hash the data yourself, as the library will take care of this for you. Otherwise, the data will be hashed twice and the data will not match the data in
GA4.

## DebugView in GA4

The DebugView in GA4 is a great tool for debugging events and user interactions. It allows you to see the data sent to the API in real-time and verify that it is correct.

However, for it to work correctly, GA4 needs to know the client ID beforehand. This means that you need to start tracking with the gtag.js before using the Measurement
Protocol API for that user.

More on that here: https://www.simoahava.com/analytics/debugview-with-ga4-measurement-protocol/

## Event list

The event list is based upon this article from Google: https://support.google.com/analytics/answer/9267735?hl=en

| Event class            | Description                                                          |
|------------------------|----------------------------------------------------------------------|
| **Generic**            |                                                                      |
| `JoinGroup`            | Tracks a user joining a group.                                       |
| `Login`                | Tracks a user login.                                                 |
| `PageView`             | Tracks a page view.                                                  |
| `Search`               | Tracks a search event.                                               |
| `Share`                | Tracks a share event.                                                |
| `SignUp`               | Tracks a sign-up event.                                              |
| **Ecommerce**          |                                                                      |
| `AddPaymentInfo`       | Tracks when users submit their payment information during checkout.  |
| `AddShippingInfo`      | Tracks when users submit their shipping information during checkout. |
| `AddToCart`            | Tracks when users add items to their shopping cart.                  |
| `AddToWishlist`        | Tracks when users add items to their wishlist.                       |
| `BeginCheckout`        | Tracks when users begin the checkout process.                        |
| `Purchase`             | Tracks when users complete a purchase.                               |
| `Refund`               | Tracks when users request a refund.                                  |
| `RemoveFromCart`       | Tracks when users remove items from their shopping cart.             |
| `SelectContent`        | Tracks when users select content.                                    |
| `SelectItem`           | Tracks when users select an item.                                    |
| `SelectPromotion`      | Tracks when users select a promotion.                                |
| `ViewCart`             | Tracks when users view their shopping cart.                          |
| `ViewItem`             | Tracks when users view an item.                                      |
| `ViewItemList`         | Tracks when users view a list of items.                              |
| `ViewPromotion`        | Tracks when users view a promotion.                                  |
| **Lead**               |                                                                      |
| `CloseConvertLead`     | Tracks when users close a lead.                                      |
| `CloseUnconvertedLead` | Tracks when users close an unconverted lead.                         |
| `DisqualifyLead`       | Tracks when users disqualify a lead.                                 |
| `GenerateLead`         | Tracks when users generate a lead.                                   |
| `QualifyLead`          | Tracks when users qualify a lead.                                    |
| `WorkingLead`          | Tracks when users work on a lead.                                    |
| **Games**              |                                                                      |
| `EarnVirtualCurrency`  | Tracks when users earn virtual currency.                             |
| `LevelEnd`             | Tracks when users complete a level.                                  |
| `LevelStart`           | Tracks when users start a level.                                     |
| `LevelUp`              | Tracks when users level up.                                          |
| `PostScore`            | Tracks when users post a score.                                      |
| `SelectContent`        | Tracks when users select content.                                    |
| `SpendVirtualCurrency` | Tracks when users spend virtual currency.                            |
| `TutorialBegin`        | Tracks when users begin a tutorial.                                  |
| `TutorialComplete`     | Tracks when users complete a tutorial.                               |
| `UnlockAchievement`    | Tracks when users unlock an achievement.                             |