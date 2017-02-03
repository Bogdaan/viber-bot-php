<?php

namespace Viber\Api\User;

use Viber\Api\Core\Entity;

/**
 * Represent user state: online, offline, unsubscribed, hidden
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class State extends Entity
{
    /**
     * Available status
     *
     * @var integer
     */
    const ONLINE = 0;
    const OFFLINE = 1;
    const UNDISCLOSED = 2;
    const ERROR = 3;
    const UNAVAILABLE = 4;

    /**
     * Viber user id
     * @var integer
     */
    protected $id;

    /**
     * User status
     * @var integer
     */
    protected $status;

    /**
     * Status description
     * @var string
     */
    protected $message;

    /**
     * Make new instance from api response array
     *
     * @param array $properties list of properties
     */
    public function __construct($properties)
    {
        if (!is_array($properties) && !$properties instanceof ArrayAccess) {
            throw new \Exception('Properties must be an array or implement ArrayAccess');
        }
        $this
            ->setId($properties['id'])
            ->setStatus($properties['online_status'])
            ->setMessage($properties['online_status_message']);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'online_status' => $this->getStatus(),
            'online_status_message' => $this->getMessage()
        ];
    }

    /**
     * Get the value of Viber user id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Viber user id
     *
     * @param integer id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Status code
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of Status code
     *
     * @param integer status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of Status description
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of Status description
     *
     * @param string message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Is user online?
     *
     * @return boolean
     */
    public function isOnline()
    {
        return $this->status == self::ONLINE;
    }
}
