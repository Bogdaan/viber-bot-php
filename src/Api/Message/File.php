<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * File as message
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class File extends Message
{
    /**
     * URL of the file
     *
     * @var string
     */
    protected $media;

    /**
     * Size of the file in bytes
     *
     * @var integer
     */
    protected $size;

    /**
     * Name of the file.
     * File name should include extension.
     * Max 256 characters (including file extension)
     *
     * @var string
     */
    protected $file_name;

    /**
     * message type
     * @return [type] [description]
     */
    public function getType()
    {
        return Type::FILE;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'media' => $this->getMedia(),
            'size' => $this->getSize(),
            'file_name' => $this->getFileName(),
        ]);
    }

    /**
     * Get the value of URL of the file
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of URL of the file
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
     * Get the value of Size of the file in bytes
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of Size of the file in bytes
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
     * Get the value of Name of the file.
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Set the value of Name of the file.
     *
     * @param string file_name
     *
     * @return static
     */
    public function setFileName($file_name)
    {
        $this->file_name = $file_name;

        return $this;
    }
}
