<?php

namespace Viber\Tests\Api;

use Viber\Tests\TestCase;
use Viber\Tests\ApiMock;
use Viber\Api\Signature;
use GuzzleHttp\Psr7\Response;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class ResponseTest extends TestCase
{
    /**
     * @expectedException \Viber\Api\Exception\ApiException
     * @expectedExceptionMessageRegExp |.*body.*|
     */
    public function testEmptyBody()
    {
        $r = \Viber\Api\Response::create(
            new Response(200, [], '')
        );
    }

    /**
     * @expectedException \Viber\Api\Exception\ApiException
     * @expectedExceptionMessageRegExp |Remote error.*|
     */
    public function testWhenErrorStatus()
    {
        $responseData = json_encode([
            'status' => 1,
        ]);
        $r = \Viber\Api\Response::create(
            new Response(200, [], $responseData)
        );
    }

    /**
     * @expectedException \Viber\Api\Exception\ApiException
     * @expectedExceptionMessageRegExp |.*json.*|
     */
    public function testInvalidJson()
    {
        $responseData = json_encode([
            'no_status' => 'no_status'
        ]);
        $r = \Viber\Api\Response::create(
            new Response(200, [], $responseData)
        );
    }
}
