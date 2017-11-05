# Cookbook

## How to secure you webhook url?

You can:

1. create long file name like `6320c1115d5bc2b6ca615b96be050884.php` and
register it as webhook url.
2. Check Viber backend IP address range (you can find it in dev docs).

## How to react on picture-message, url-message etc. ?

You need to create own event checker. For example:

```php
// ...
// $bot - \Viber\Bot instance
$bot->on(function ($event) {
    return isThisIsCatPicture(event);
}, function ($event) {
    // process cat pictures here
});
```

## How to process user conversation

## How to track message delivery?

Inside viber ecosystem each device/client send delivery status. So, if you want to track delivery process you can:

First, subscribe to delivery events:

```php
use Viber\Api\Event\Type;

// ...
// register to all events
$result = $client->setWebhook($webhookUrl, [
    Type::DELIVERED,  // if message delivered to device
    Type::SEEN,       // if message is seen device
    Type::FAILED,     // if message not delivered
    Type::SUBSCRIBED,
    Type::UNSUBSCRIBED,
    Type::CONVERSATION,
    Type::MESSAGE
]);
```

Then setup event handler callback inside bot-manager:

```php
// ...
$bot
->on(function (Event $event) {
    return ($event instanceof \Viber\Api\Event\DELIVERED);
}, function($event) {
    // process delivered
})
->on(function (Event $event) {
    return ($event instanceof \Viber\Api\Event\SEEN);
}, function($event) {
    // process seen
})
->on(function (Event $event) {
    return ($event instanceof \Viber\Api\Event\FAILED);
}, function($event) {
    // process failed
});
```

## How to request user phone?

You need to setup minimal API version to 3:

```php
$bot->getClient()->sendMessage(
    (new \Viber\Api\Message\Text())
    ->setSender($botSender)
    ->setReceiver($event->getSender()->getId())
    ->setMinApiVersion(3)
    ->setText("We need your phone number")
    ->setKeyboard(
    (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                    ->setActionType('share-phone')
                    ->setActionBody('reply')
                    ->setText('Send phone number')
                ])
    )
);
```

## Integration (api.ai, botan.io and others)
