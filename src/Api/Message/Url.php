<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Url as message
 */
class Url extends Message
{
    /**
     * URL. Max 2,000 characters
     * @var string
     */
    protected $media;

    /**
     * message type
     * @return [type] [description]
     */
    public function getType()
    {
        return 'url';
    }
}
