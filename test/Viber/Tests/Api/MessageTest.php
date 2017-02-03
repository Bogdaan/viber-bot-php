<?php

namespace Viber\Tests\Api;

use Viber\Tests\TestCase;
use Viber\Api\Message;
use Viber\Api\Sender;
use Viber\Api\Keyboard;
use Viber\Api\Keyboard\Button;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class MessageTest extends TestCase
{
    public function testNestedToArray()
    {
        $message =
            (new Message())
            ->setSender(new Sender())
            ->setReceiver('some-user-id')
            ->setTrackingData('user-track')
            ->setKeyboard(
                (new Keyboard())
                ->setButtons([
                    (new Button())
                    ->setActionType('open-url')
                    ->setActionBody('https://some.url')
                ])
            );

        $this->assertEquals('open-url',
            $message->getKeyboard()->getButtons()[0]->getActionType());
    }
}
