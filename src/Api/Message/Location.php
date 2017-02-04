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
     * Location coordinates. With "lat" and "lon" keys
     *
     * @var array
     */
    protected $location = ['lat' => 0, 'lon' => 0];

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::LOCATION;
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
     * @param array location [lat => 0, lon => 0]
     *
     * @return self
     */
    public function setLocation(array $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Set latitude coordinate part
     *
     * @param float $lat
     *
     * @return self
     */
    public function setLat($lat)
    {
        $this->location['lat'] = $lat;

        return $this;
    }

    /**
     * Set longitude coordinate part
     *
     * @param float $lon
     *
     * @return self
     */
    public function setLng($lon)
    {
        $this->location['lon'] = $lon;

        return $this;
    }
}
