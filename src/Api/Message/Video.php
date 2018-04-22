<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Video as message
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Video extends Message
{
    /**
     * URL of the video (MP4, H264)
     *
     * @var string
     */
    protected $media;

    /**
     * Size of the video in bytes
     *
     * @var integer
     */
    protected $size;

    /**
     * Video duration in seconds
     *
     * @var integer
     */
    protected $duration;

    /**
     * URL of a reduced size image (JPEG)
     *
     * @var string
     */
    protected $thumbnail;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::VIDEO;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'media' => $this->getMedia(),
            'size' => $this->getSize(),
            'duration' => $this->getDuration(),
            'thumbnail' => $this->getThumbnail(),
        ]);
    }

    /**
     * Get the value of URL of the video (MP4, H264)
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of URL of the video (MP4, H264)
     *
     * @param string media
     *
     * @return static
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get the value of Size of the video in bytes
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of Size of the video in bytes
     *
     * @param integer size
     *
     * @return static
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of Video duration in seconds
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of Video duration in seconds
     *
     * @param integer duration
     *
     * @return static
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of URL of a reduced size image (JPEG)
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set the value of URL of a reduced size image (JPEG)
     *
     * @param string thumbnail
     *
     * @return static
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}
