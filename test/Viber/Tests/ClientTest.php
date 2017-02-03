<?php

namespace Viber\Tests;

use Viber\Api\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class ClientTest extends TestCase
{
    /**
     * @expectedException \Viber\Exception\ViberException
     */
    public function testConstructor()
    {
        new Client();
    }

    public function testSetWebhook()
    {
        $handler = HandlerStack::create(
            new MockHandler([
                new Response(200, ['X-Viber-Content-Signature' => 'nope']),
                new RequestException("some error", new Request('GET', 'test'))
            ])
        );

        $client = new Client([
            'token' => 'some-token',
            'http' => [
                'handler' => $handler
            ]
        ]);

        $client->setWebhook('https://some.url');
    }
}
