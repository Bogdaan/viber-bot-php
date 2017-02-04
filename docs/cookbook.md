# Cookbook

## How to react on picture-message, url-message etc. ?

You need to create own event checker. For example:
```
<?php
// ...
// $bot - \Viber\Bot instance
$bot->on(function ($event) {
    return isThisIsCatPicture(event);
}, function ($event) {
    // process cat pictures here
});
```

## How to process user conversation

## How to track message delivery

## Integration (api.ai, botan.io and others)
