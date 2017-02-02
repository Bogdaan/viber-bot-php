<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Video message
 */
class Video extends Message
{
    /**
     * URL of the video (MP4, H264)
     * @var string
     */
    protected $media;

    /**
     * Size of the video in bytes
     * @var integer
     */
    protected $size;

    /**
     * Video duration in seconds
     * @var integer
     */
    protected $duration;

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
        return 'video';
    }
}
