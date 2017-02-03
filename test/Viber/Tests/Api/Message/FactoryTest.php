<?php

namespace Viber\Tests\Api\Message;

use Viber\Tests\TestCase;
use Viber\Api\Message\Factory;
use Viber\Api\Message\Type;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class FactoryTest extends TestCase
{
    /**
     * @expectedException \Viber\Api\Exception\ApiException
     */
    public function testUnknowType()
    {
        Factory::makeFromApi(['type' => '-']);
    }

    // TODO implement each sample
    private function build($type)
    {
        return [
            "type" => $type,
            "text" => "a message to the service",
            "media" => "http://example.com",
            "location" => [
                "lat" => 50.76891,
                "lon" => 6.11499
            ],
            "tracking_data" => "tracking data",
        ];
    }

    public function testMakeFromApi()
    {
        $testList = [
            Type::TEXT,
            Type::PICTURE,
            Type::VIDEO,
            Type::FILE,
            Type::STICKER,
            Type::CONTACT,
            Type::URL,
            Type::LOCATION
        ];
        foreach ($testList as $messageType) {
            $message = Factory::makeFromApi( $this->build($messageType) );
            $this->assertEquals('Viber\\Api\\Message\\'.ucfirst($messageType), get_class($message));
        }
    }
}
