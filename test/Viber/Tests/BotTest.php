<?php

namespace Viber\Tests;

use Viber\Bot;
use Viber\Api\Event;
use Viber\Api\Signature;

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
                Signature::make('-', $inputBody)
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
                Signature::make('-', $inputBody)
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
                Signature::make('-', $inputBody)
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
                Signature::make('-', $inputBody)
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
}
