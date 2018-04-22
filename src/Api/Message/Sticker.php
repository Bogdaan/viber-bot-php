<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Sticker as message
 *
 * @see https://developers.viber.com/tools/sticker-ids/index.html
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Sticker extends Message
{
    /**
     * Unique Viber sticker ID.
     *
     * @var integer
     */
    protected $sticker_id;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::STICKER;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'sticker_id' => $this->getStickerId(),
        ]);
    }

    /**
     * Get the value of Unique Viber sticker ID.
     *
     * @return integer
     */
    public function getStickerId()
    {
        return $this->sticker_id;
    }

    /**
     * Set the value of Unique Viber sticker ID.
     *
     * @param integer sticker_id
     *
     * @return static
     */
    public function setStickerId($sticker_id)
    {
        $this->sticker_id = $sticker_id;

        return $this;
    }
}
