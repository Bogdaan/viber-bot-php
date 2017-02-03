<?php

namespace Viber\Tests\Api\Event;

use Viber\Tests\TestCase;
use Viber\Api\Event\Message as MessageEvent;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class MessageTest extends TestCase
{
    public function testConstructor()
    {
        $event = new MessageEvent([
            "event" => "message",
            "timestamp" => 1457764197627,
            "message_token" => 4912661846655238145,
            "sender" => [
                "id" => "01234567890A=",
                "name" => "John McClane",
                "avatar" => "http://avatar.example.com"
            ],
            "message" => [
                "type" => "text",
                "text" => "msg",
                "media" => "http://example.com",
                "location" => [
                    "lat" => 50.76891,
                    "lon" => 6.11499
                ],
                "tracking_data" => "tracking data"
            ]
        ]);
        $this->assertEquals("msg", $event->getMessage()->getText());
    }
}
