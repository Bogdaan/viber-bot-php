<?php

namespace Viber\Api;

use Viber\Api\Exception\ApiException;

/**
 * Viber user
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class User extends Entity
{
    /**
     * Unique Viber user id
     *
     * @var string
     */
    protected $id;

    /**
     * User name
     *
     * @var string
     */
    protected $name;

    /**
     * URL of the user's avatar
     *
     * @var string
     */
    protected $avatar;

    /**
     * User's country code
     *
     * @var string
     */
    protected $country;

    /**
     * User’s phone language. Will be returned according to the device language
     *
     * @see ISO 639-1
     *
     * @var string
     */
    protected $language;

    /**
     * The operating system type and version of the user's primary device.
     *
     * @var string
     */
    protected $primary_device_os;

    /**
     * Max API version, matching the most updated user's device
     *
     * @var integer
     */
    protected $api_version;

    /**
     * The Viber version installed on the user's primary device
     *
     * @var string
     */
    protected $viber_version;

    /**
     * Mobile country code
     *
     * @var string
     */
    protected $mcc;

    /**
     * Mobile network code
     *
     * @var string
     */
    protected $mnc;

    /**
     * Create user instance from api response array
     *
     * @throws \Viber\Api\Exception\ApiException
     * @param  array $properties list of properties
     */
    public function __construct($properties)
    {
        if (!is_array($properties) && !$properties instanceof \ArrayAccess) {
            throw new ApiException('Properties must be an array or implement ArrayAccess');
        }
        foreach ($properties as $propertyName => $propertyValue) {
            if (property_exists($this, $propertyName)) {
                $this->$propertyName = $propertyValue;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'avatar' => $this->getAvatar(),
            'country' => $this->getCountry(),
            'language' => $this->getLanguage(),
            'primary_device_os' => $this->getPrimaryDeviceOs(),
            'api_version' => $this->getApiVersion(),
            'viber_version' => $this->getViberVersion(),
            'mcc' => $this->getMcc(),
            'mnc' => $this->getMnc(),
        ];
    }

    /**
     * Get the value of Unique Viber user id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of User's Viber name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of URL of the user's avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get the value of User's country code
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the value of User’s phone language. Will be returned according to the device language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Get the value of The operating system type and version of the user's primary device.
     *
     * @return string
     */
    public function getPrimaryDeviceOs()
    {
        return $this->primary_device_os;
    }

    /**
     * Get the value of Max API version, matching the most updated user's device
     *
     * @return integer
     */
    public function getApiVersion()
    {
        return $this->api_version;
    }

    /**
     * Get the value of The Viber version installed on the user's primary device
     *
     * @return string
     */
    public function getViberVersion()
    {
        return $this->viber_version;
    }

    /**
     * Get the value of Mobile country code
     *
     * @return string
     */
    public function getMcc()
    {
        return $this->mcc;
    }

    /**
     * Get the value of Mobile network code
     *
     * @return string
     */
    public function getMnc()
    {
        return $this->mnc;
    }
}
