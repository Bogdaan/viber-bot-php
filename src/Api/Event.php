<?php

namespace Viber\Api;

use Viber\Api\User;
use Viber\Api\Sender;
use Viber\Api\Message\Factory as MessageFactory;

/**
 * General event data
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Event
{
    /**
     * Event type
     *
     * @var string
     */
    protected $event;

    /**
     * Time of the event that triggered the callback
     *
     * @var integer
     */
    protected $timestamp;

    /**
     * Unique ID of the message
     *
     * @var string
     */
    protected $message_token;

    /**
     * Init event from api array
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        foreach ($properties as $propName => $propValue) {
            if (property_exists(get_class($this), $propName)) {
                if ($propName == 'sender') {
                    $this->sender = new Sender($propValue);
                } elseif ($propName == 'message') {
                    $this->message = MessageFactory::makeFromApi($propValue);
                } elseif ($propName == 'user') {
                    $this->user = new User($propValue);
                } else {
                    $this->$propName = $propValue;
                }
            }
        }
    }

    /**
     * Get the value of Event type
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Alias for getEvent
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->getEvent();
    }

    /**
     * Get the value of Time of the event that triggered the callback
     *
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the value of Unique ID of the message
     *
     * @return string
     */
    public function getMessageToken()
    {
        return $this->message_token;
    }
}
