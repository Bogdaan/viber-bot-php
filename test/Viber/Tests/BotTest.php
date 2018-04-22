<?php

namespace Viber\Tests;

use Viber\Bot;
use Viber\Api\Event;
use Viber\Api\Signature;

require_once(__DIR__.'/Functions.php');

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class BotTest extends TestCase
{
    /**
     * @expectedException \RuntimeException
     */
    public function testNoOptions()
    {
        new Bot([]);
    }

    public function testGetClient()
    {
        $bot = new Bot(['token' => '-']);
        $this->assertInstanceOf(\Viber\Client::class, $bot->getClient());
    }

    public function testRegisterHandler()
    {
        $bot = new Bot(['token' => '-']);
        $totalCalls = 0;
        $bot
        ->on(
            function ($e) use (&$totalCalls) {
                $totalCalls++;
                return true;
            },
            function ($e) use (&$totalCalls) {
                $totalCalls++;
                return true;
            }
        )
        ->run(new Event([]));
        $this->assertEquals(2, $totalCalls);
    }

    public function testTextHandler()
    {
        $bot = new Bot(['token' => '-']);
        $totalCalls = 0;
        $bot
        ->onText(
            '|-|s',
            function ($e) use (&$totalCalls) {
                $totalCalls++;
                return true;
            }
        )
        ->run(new Event([]));
        $this->assertEquals(0, $totalCalls);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessageRegExp |.*header not found.*|
     */
    public function testRunNoHeader()
    {
        $bot = new Bot(['token' => '-']);
        $bot->run();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessageRegExp |.*Event.*|
     */
    public function testRunInvalidParams()
    {
        $bot = new Bot(['token' => '-']);
        $bot->run('some arg');
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessageRegExp |Invalid signature.*|
     */
    public function testInvalidSignature()
    {
        $stub = $this->getMock(
            Bot::class,
            ['getInputBody', 'getSignHeaderValue'],
            [['token' => '-']]
        );

        $stub->method('getInputBody')
            ->willReturn('1');
        $stub->method('getSignHeaderValue')
            ->willReturn('2');

        $stub->run();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessageRegExp |Invalid json.*|
     */
    public function testInvalidBody()
    {
        $stub = $this->getMock(
            Bot::class,
            ['getInputBody', 'getSignHeaderValue'],
            [['token' => '-']]
        );

        $inputBody = '1'; // valid json

        $stub->method('getInputBody')
            ->willReturn($inputBody);

        $stub->method('getSignHeaderValue')
            ->willReturn(
                Signature::make($inputBody, '-')
            );

        $stub->run();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessageRegExp |Invalid json.*|
     */
    public function testInvalidJsonBody()
    {
        $stub = $this->getMock(
            Bot::class,
            ['getInputBody', 'getSignHeaderValue'],
            [['token' => '-']]
        );

        $inputBody = '}{'; // invalid json

        $stub->method('getInputBody')
            ->willReturn($inputBody);
        $stub->method('getSignHeaderValue')
            ->willReturn(
                Signature::make($inputBody, '-')
            );

        $stub->run();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessageRegExp |Invalid json.*|
     */
    public function testEmptyJsonBody()
    {
        $stub = $this->getMock(
            Bot::class,
            ['getInputBody', 'getSignHeaderValue'],
            [['token' => '-']]
        );

        $inputBody = '{}'; // empty object

        $stub->method('getInputBody')
            ->willReturn($inputBody);
        $stub->method('getSignHeaderValue')
            ->willReturn(
                Signature::make($inputBody, '-')
            );

        $stub->run();
    }

    /**
     * @expectedException \Viber\Api\Exception\ApiException
     */
    public function testUnknowJsonBody()
    {
        $stub = $this->getMock(
            Bot::class,
            ['getInputBody', 'getSignHeaderValue'],
            [['token' => '-']]
        );

        $inputBody = '{"event": "-"}'; // unknow event

        $stub->method('getInputBody')
            ->willReturn($inputBody);
        $stub->method('getSignHeaderValue')
            ->willReturn(
                Signature::make($inputBody, '-')
            );

        $stub->run();
    }

    public function testOnText()
    {
        $bot = new Bot(['token' => '-']);
        $totalCalls = 0;
        $bot
        ->onText('|ping .*|s', function ($e) use (&$totalCalls) {
            $totalCalls++;
        })
        ->onText('|pong .*|s', function ($e) use (&$totalCalls) {
            $totalCalls++;
        })
        ->run(
            new \Viber\Api\Event\Message([
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
                    "text" => "ping me",
                    "media" => "http://example.com",
                    "location" => [
                        "lat" => 50.76891,
                        "lon" => 6.11499
                    ],
                    "tracking_data" => "tracking data"
                ]
            ])
        );
        $this->assertEquals(1, $totalCalls);
    }

    public function testOnPicture()
    {
        $bot = new Bot(['token' => '-']);
        $totalCalls = 0;
        $bot
            ->onPicture(function ($e) use (&$totalCalls) {
                $totalCalls++;
            })
            ->run(
                new \Viber\Api\Event\Message([
                    "event" => "message",
                    "timestamp" => 1457764197627,
                    "message_token" => 4912661846655238145,
                    "sender" => [
                        "id" => "01234567890A=",
                        "name" => "John McClane",
                        "avatar" => "http://avatar.example.com"
                    ],
                    "message" => [
                        "type" => "picture",
                        "text" => "Photo description",
                        "media" => "http://www.images.com/img.jpg",
                        "thumbnail" => "http://www.images.com/thumb.jpg",
                        "tracking_data" => "tracking data"
                    ]
                ])
            );
        $this->assertEquals(1, $totalCalls);
    }

    public function testOnConversation()
    {
        $bot = new Bot(['token' => '-']);
        $totalCalls = 0;
        $bot
        ->onConversation(function ($e) use (&$totalCalls) {
            $totalCalls++;
        })
        ->run(
            new \Viber\Api\Event\Conversation([
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
            ])
        );
        $this->assertEquals(1, $totalCalls);
    }

    public function testConversationReply()
    {
        $textMessage = new \Viber\Api\Message\Text([
            'sender' => [
                'name' => 'hi bot',
                'avatar' => 'https://my.avatar/pict.jpg'
            ],
            'receiver' => '01234567890A=',
            'text' => 'Can i help you?',
            'tracking_data' => 'hi-conversation',
        ]);
        \Viber\Output::reset();
        $this->expectOutputString(
            json_encode($textMessage->toApiArray())
        );
        // build bot
        (new Bot(['token' => '-']))
        ->onConversation(function ($e) use ($textMessage) {
            return $textMessage;
        })
        ->run(
            new \Viber\Api\Event\Conversation([
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
            ])
        );
        $this->assertContains('Content-Type: application/json', \Viber\Output::$headers);
    }
}
