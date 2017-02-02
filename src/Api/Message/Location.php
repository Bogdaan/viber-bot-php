<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Location as message
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Location extends Message
{
    /**
     * Location coordinates.
     *
     * @var array
     */
    protected $location;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'location' => $this->getLocation()
        ]);
    }

    /**
     * Get the value of Location coordinates.
     *
     * @return array
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of Location coordinates.
     *
     * @param array location [lat => 0, lng => 0]
     *
     * @return self
     */
    public function setLocation(array $location)
    {
        $this->location = $location;

        return $this;
    }

}
