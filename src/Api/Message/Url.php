<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Url as message
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Url extends Message
{
    /**
     * URL. Max 2,000 characters
     *
     * @var string
     */
    protected $media;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::URL;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'media' => $this->getMedia()
        ]);
    }

    /**
     * Get the value of URL. Max 2,000 characters
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of URL. Max 2,000 characters
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
}
