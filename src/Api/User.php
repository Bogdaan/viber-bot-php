<?php

namespace Viber\Api;

/**
 * Viber user representation
 */
class User
{
    /**
     * Unique Viber user id
     * @var integer
     */
    protected $id;

    /**
     * User's Viber name
     * @var string
     */
    protected $name;

    /**
     * URL of the user's avatar
     * @var string
     */
    protected $avatar;

    /**
     * User's country code
     * @var string
     */
    protected $country;

    /**
     * User’s phone language. Will be returned according to the device language
     * @see ISO 639-1
     * @var string
     */
    protected $language;

    /**
     * The operating system type and version of the user's primary device.
     * @var string
     */
    protected $primary_device_os;

    /**
     * Max API version, matching the most updated user's device
     * @var integer
     */
    protected $api_version;

    /**
     * The Viber version installed on the user's primary device
     * @var string
     */
    protected $viber_version;

    /**
     * Mobile country code
     * @var string
     */
    protected $mcc;

    /**
     * Mobile network code
     * @var string
     */
    protected $mnc;
}
