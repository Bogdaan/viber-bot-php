<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Text-only message
 */
class Text extends Message
{
    /**
     * The text of the message
     * @var [type]
     */
    protected $text;

    /**
     * message type
     * @return [type] [description]
     */
    public function getType()
    {
        return 'text';
    }
}
