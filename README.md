# PHP sdk for Viber api

Library to develop a bot for the Viber platform. [Create you first Viber bot setp by step](docs/first-steps.md)

## Installation

```
composer require bogdaan/viber-bot-php
```

## Example

```
<?php

require_once("../vendor/autoload.php");

use Viber\Bot;
use Viber\Api\Sender;

$apiKey = '<PLACE-YOU-API-KEY-HERE>';

// reply name
$botSender = new Sender([
    'name' => 'Whois bot',
    'avatar' => 'https://developers.viber.com/img/favicon.ico',
]);

try {
    $bot = new Bot(['token' => $apiKey]);
    $bot
    ->onConversation(function ($event) use ($bot, $botSender) {
        // this event fires if user open chat, you can return "welcome message"
        // to user, but you can't send more messages!
        return (new \Viber\Api\Message\Text())
            ->setSender($botSender)
            ->setText("Can i help you?");
    })
    ->onText('|whois .*|si', function ($event) use ($bot, $botSender) {
        // match by template, for example "whois Bogdaan"
        $bot->getClient()->sendMessage(
            (new \Viber\Api\Message\Text())
            ->setSender($botSender)
            ->setReceiver($event->getSender()->getId())
            ->setText("I do not know )")
        );
    })
    ->run();
} catch (Exception $e) {
    // todo - log exceptions
}
```

See more in **examples** directory.

## Read more

- [Create you first Viber bot](docs/first-steps.md)
- [Cookbook](docs/cookbook.md)
- [REST api documentation](https://developers.viber.com/api/rest-bot-api/index.html)
- [SDK for node](https://github.com/Viber/viber-bot-node)
- [SDK for python](https://github.com/Viber/viber-bot-python)


## Features

- [x] all api entities
- [x] validate request and response signs
- [x] provide webhook interface
- [x] provide event interface
- [ ] wrap all api response to entities
- [ ] validate api entities before submit?
- [ ] implement log levels with monolog?
- [ ] post on public page

## Contributing

Pull requests are welcome.
