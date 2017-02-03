# PHP sdk for Viber api

Library to develop a bot for the Viber platform.

## Installation

```
composer require bogdaan/viber-bot-php
```

## Example

```
<?php

require_once("vendor/autoload.php");

use Viber\Bot;
use Viber\Api\Sender;
use Viber\Api\Message\Text as TextMessage;

$bot = new Bot([ 'token' => '<YOU-TOKEN-HERE>' ]);
$apiClient = $bot->getClient();

$botSender = new Sender([
    'name' => 'Hello bot',
    'avatar' => 'http://my.avatar/path.jpg',
]);

$bot
->onText("|hello .*|s", function ($event) use ($apiClient) {
    // reply to sender
    $apiClient->sendMessage(
        (new \Viber\Api\Message\Text())
        ->setReceiver($event->getSender()->getId())
        ->setSender(botSender)
        ->setText("Hi!");
    );    
})
->onSubscribe(function ($event) use ($apiClient) {
    // reply with "welcome" message
    return (new \Viber\Api\Message\Text())
        ->setReceiver($event->getSender()->getId())
        ->setSender(botSender)
        ->setText("Can i help you?");
})
->on(function ($event) {
    return (
        $event->getEvent() == \Viber\Api\Event\Type::TEXT
        && $event->getMessage()->getType() == \Viber\Api\Message\Type::PICTURE
    );
}, function ($event) use ($apiClient) {
    // if user send picture
    return (new \Viber\Api\Message\Text())
        ->setReceiver($event->getSender()->getId())
        ->setSender(botSender)
        ->setText("Cool picture");
})
->on(function ($event) {
    return ($event->getEvent() == \Viber\Api\Event\Type::UNSUBSCRIBED);
}, function ($event) use ($apiClient) {
    // process all UNSUBSCRIBED events
})
->on(function ($event) {
    return true; // check if we need process this event?
}, function ($event) use ($apiClient) {
    // <--- ALL OTHER EVENTS PROCESS HERE
})
->run();
```

## Features

[x] all api entities
[x] validate request and response signs
[x] provide webhook interface
[x] provide event interface
[ ] wrap all api response to entities
[ ] validate api entities before submit?
[ ] implement log levels with monolog
