<?php

namespace Viber\Api;

use Viber\Api\Core\Entity;

/**
 * Viber general message object
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Message extends Entity
{
    /**
     * Viber user
     *
     * @var \Viber\Api\User
     */
    protected $receiver;

    /**
     * Message type
     *
     * @var string
     */
    protected $type;

    /**
     * Sender information
     *
     * @var \Viber\Api\Sender
     */
    protected $sender;

    /**
     * Track messages and user’s replies. Passed back with user’s reply
     *
     * @var string
     */
    protected $tracking_data;

    /**
     * API version required by clients
     *
     * @var integer
     */
    protected $min_api_version = 1;

    /**
     * Custom keyboard for message
     *
     * @var \Viber\Api\Keyboard
     */
    protected $keyboard;

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'receiver' => $this->getReceiver(),
            'type' => $this->getType(),
            'sender' => $this->getSender(),
            'tracking_data' => $this->getTrackingData(),
            'min_api_version' => $this->getMinApiVersion(),
            'keyboard' => $this->getKeyboard()
        ];
    }

    /**
     * Get the value of Viber user
     *
     * @return \Viber\Api\User
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of Viber user
     *
     * @param \Viber\Api\User receiver
     *
     * @return self
     */
    public function setReceiver(\Viber\Api\User $receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get the value of Message type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of Message type
     *
     * @param string type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of Sender information
     *
     * @return \Viber\Api\Sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set the value of Sender information
     *
     * @param \Viber\Api\Sender sender
     *
     * @return self
     */
    public function setSender(\Viber\Api\Sender $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the value of Track messages and user’s replies. Passed back with user’s reply
     *
     * @return string
     */
    public function getTrackingData()
    {
        return $this->tracking_data;
    }

    /**
     * Set the value of Track messages and user’s replies. Passed back with user’s reply
     *
     * @param string tracking_data
     *
     * @return self
     */
    public function setTrackingData($tracking_data)
    {
        $this->tracking_data = $tracking_data;

        return $this;
    }

    /**
     * Get the value of API version required by clients
     *
     * @return integer
     */
    public function getMinApiVersion()
    {
        return $this->min_api_version;
    }

    /**
     * Set the value of API version required by clients
     *
     * @param integer min_api_version
     *
     * @return self
     */
    public function setMinApiVersion($min_api_version)
    {
        $this->min_api_version = $min_api_version;

        return $this;
    }

    /**
     * Get the value of Custom keyboard for message
     *
     * @return \Viber\Api\Keyboard
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * Set the value of Custom keyboard for message
     *
     * @param \Viber\Api\Keyboard keyboard
     *
     * @return self
     */
    public function setKeyboard(\Viber\Api\Keyboard $keyboard)
    {
        $this->keyboard = $keyboard;

        return $this;
    }

}
