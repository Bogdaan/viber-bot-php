<?php

namespace Viber\Tests\Api\Event;

use Viber\Tests\TestCase;
use Viber\Api\Event\Factory;
use Viber\Api\Event\Type;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class FactoryTest extends TestCase
{
    /**
     * @expectedException \Viber\Api\Exception\ApiException
     * @expectedExceptionMessageRegExp |Unknow.*|
     */
    public function testUnknowEvent()
    {
        Factory::makeFromApi([]);
    }

    /**
     * @expectedException \Viber\Api\Exception\ApiException
     * @expectedExceptionMessageRegExp |Unknow.*|
     */
    public function testUnknowEventName()
    {
        Factory::makeFromApi([
            'event' => '8)'
        ]);
    }

    public function testMakeFromApi()
    {
        $eventDataList = [
            [
                'type' => Type::DELIVERED,
                'class' => \Viber\Api\Event\Delivered::class,
                'sample' => [
                    "event" => "delivered",
                    "timestamp" => 1457764197627,
                    "message_token" => 491266184665523145,
                    "user_id" => "01234567890A="
                ]
            ],
            [
                'type' => Type::SUBSCRIBED,
                'class' => \Viber\Api\Event\Subscribed::class,
                'sample' => [
                    "event" => "subscribed",
                    "timestamp" => 1457764197627,
                    "user" => [
                        "id" => "01234567890A=",
                        "name" => "John McClane",
                        "avatar" => "http://avatar.example.com",
                        "country" => "UK",
                        "language" => "en",
                        "api_version" => 1
                    ],
                    "message_token" => 4912661846655238145
                ]
            ],
            [
                'type' => Type::UNSUBSCRIBED,
                'class' => \Viber\Api\Event\Unsubscribed::class,
                'sample' => [
                    "event" => "unsubscribed",
                    "timestamp" => 1457764197627,
                    "user_id" => "01234567890A=",
                    "message_token" => 4912661846655238145
                ],
            ],
            [
                'type' => Type::CONVERSATION,
                'class' => \Viber\Api\Event\Conversation::class,
                'sample' => [
                    "event" => "conversation_started",
                    "timestamp" => 1457764197627,
                    "message_token" => 4912661846655238145,
                    "type" => "open",
                    "context" => "context information",
                    "user" => [
                        "id" => "01234567890A=",
                        "name" => "John McClane",
                        "avatar" => "http://avatar.example.com",
                        "country" => "UK",
                        "language" => "en",
                        "api_version" => 1
                    ]
                ],
            ],
            [
                'type' => Type::DELIVERED,
                'class' => \Viber\Api\Event\Delivered::class,
                'sample' => [
                    "event" => "delivered",
                    "timestamp" => 1457764197627,
                    "message_token" => 4912661846655238145,
                    "user_id" => "01234567890A="
                ]
            ],
            [
                'type' => Type::SEEN,
                'class' => \Viber\Api\Event\Seen::class,
                'sample' => [
                    "event" => "seen",
                    "timestamp" => 1457764197627,
                    "message_token" => 4912661846655238145,
                    "user_id" => "01234567890A="
                ]
            ],
            [
                'type' => Type::FAILED,
                'class' => \Viber\Api\Event\Failed::class,
                'sample' => [
                    "event" => "failed",
                    "timestamp" => 1457764197627,
                    "message_token" => 4912661846655238145,
                    "user_id" => "01234567890A=",
                    "desc" => "failure description."
                ]
            ],
            [
                'type' => Type::MESSAGE,
                'class' => \Viber\Api\Event\Message::class,
                'sample' => [
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
                        "text" => "a message to the service",
                        "media" => "http://example.com",
                        "location" => [
                            "lat" => 50.76891,
                            "lon" => 6.11499
                        ],
                        "tracking_data" => "tracking data"
                    ]
                ]
            ],
        ];

        foreach ($eventDataList as $dataItem) {
            $event = Factory::makeFromApi($dataItem['sample']);
            $this->assertInstanceOf($dataItem['class'], $event);
            $this->assertEquals($dataItem['sample']['event'], $event->getEventType());
        }
    }
}
