<?php

namespace Viber\Api;

use Viber\Api\Core\Entity;

/**
 * Message sender
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Sender implements Entity
{
    /**
     * Viber User id
     * @var [type]
     */
    protected $id;
    
    /**
     * Viber name
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
     * Make new instance from api response
     *
     * @param  array $properties list of properties
     */
    public function __construct($properties)
    {
        if (!is_array($properties) && !$properties instanceof ArrayAccess) {
            throw new \Exception('Properties must be an array or implement ArrayAccess');
        }
        isset($properties['name'])? $this->setName($properties['name']): null;
        isset($properties['avatar'])? $this->setName($properties['avatar']): null;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'avatar' => $this->getAvatar()
        ];
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
     * Set the value of User's Viber name
     *
     * @param string name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set the value of URL of the user's avatar
     *
     * @param string avatar
     *
     * @return self
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

}
