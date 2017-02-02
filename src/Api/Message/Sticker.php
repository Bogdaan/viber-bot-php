<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Text-only message
 */
class Sticker extends Message
{
    /**
     * Unique Viber sticker ID.
     * @see https://developers.viber.com/tools/sticker-ids/index.html
     * @var integer
     */
    protected $sticker_id;

    /**
     * message type
     * @return [type] [description]
     */
    public function getType()
    {
        return 'text';
    }
}
