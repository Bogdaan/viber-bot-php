<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Location as message
 */
class Location extends Message
{
    /**
     * Location coordinates
     * @var Location
     */
    protected $location;

    /**
     * message type
     * @return [type] [description]
     */
    public function getType()
    {
        return 'location';
    }
}
