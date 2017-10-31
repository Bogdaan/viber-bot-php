<?php

namespace Viber\Tests;

use Viber\Client;
use Viber\Tests\ApiMock;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class ClientTest extends TestCase
{
    /**
     * @expectedException \Viber\Api\Exception\ApiException
     * @expectedExceptionMessageRegExp |^No token .*|
     */
    public function testNoToken()
    {
        new Client([]);
    }

    /**
     * @expectedException \Viber\Api\Exception\ApiException
     * @expectedExceptionMessageRegExp |^Invalid webhook .*|
     */
    public function testInvalidHttpHook()
    {
        (new Client([
            'token' => 'some-token'
        ]))
        ->setWebhook('http://some.url');
    }

    /**
     * @expectedException \Viber\Api\Exception\ApiException
     * @expectedExceptionMessageRegExp |Remote error: ...|
     */
    public function testServerError()
    {
        $responseData = json_encode([
            'status' => 3,
            'status_message' => '...',
        ]);
        $handler = HandlerStack::create(
            new MockHandler([
                new Response(200, [], $responseData),
            ])
        );
        $client = new Client([
            'token' => 'token',
            'http' => [
                'handler' => $handler
            ]
        ]);
        $apinInfo = $client->call('get_account_info', []);
    }
}
