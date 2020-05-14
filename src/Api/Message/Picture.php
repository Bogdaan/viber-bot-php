<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Picture as message
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
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
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::PICTURE;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'text' => $this->getText(),
            'media' => $this->getMedia(),
            'thumbnail' => $this->getThumbnail(),
            'size' => $this->getSize(),
            'file_name' => $this->getFileName(),
        ]);
    }

    /**
     * Get the value of Description of image
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of Description of image
     *
     * @param string text
     *
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of URL of the image (JPEG)
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of URL of the image (JPEG)
     *
     * @param string media
     *
     * @return self
     */
    public function setMedia($media)
    {
        $this->media = $media;

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
     * @return self
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

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
