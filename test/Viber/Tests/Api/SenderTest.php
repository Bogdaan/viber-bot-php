<?php

namespace Viber\Tests\Api;

use Viber\Tests\TestCase;
use Viber\Api\Sender;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class SenderTest extends TestCase
{
    public function testToArray()
    {
        $properties = [
            'id' => '1',
            'name' => '2',
            'avatar' => '3'
        ];
        $sender = new Sender($properties);
        $this->assertEquals($properties, $sender->toArray());
        $this->assertEquals($properties, $sender->toApiArray());
    }

    public function testNullValues()
    {
        $properties = [
            'name' => '2'
        ];
        $sender = new Sender($properties);
        $this->assertEquals($properties, $sender->toApiArray());
    }
}
