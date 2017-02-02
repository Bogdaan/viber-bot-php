<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * File as message
 */
class File extends Message
{
    /**
     * URL of the file
     * @var string
     */
    protected $media;

    /**
     * Size of the file in bytes
     * @var integer
     */
    protected $size;

    /**
     * Name of the file.
     * File name should include extension.
     * Max 256 characters (including file extension)
     * @var string
     */
    protected $file_name;

    /**
     * message type
     * @return [type] [description]
     */
    public function getType()
    {
        return 'file';
    }
}
