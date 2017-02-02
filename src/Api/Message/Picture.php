<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Picture message
 */
class Picture extends Message
{
    /**
     * Description of image
     * @var string
     */
    protected $text;

    /**
     * URL of the image (JPEG)
     * @var string
     */
    protected $media;

    /**
     * URL of a reduced size image (JPEG)
     * @var string
     */
    protected $thumbnail;

    /**
     * message type
     * @return [type] [description]
     */
    public function getType()
    {
        return 'picture';
    }
}
