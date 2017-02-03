<?php

namespace Viber\Api\Event;

use Viber\Api\Event;

/**
 * Triggers when user send message
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Message extends Event
{
    /**
     * Who send message
     *
     * @var \Viber\Api\Sender
     */
    protected $sender;

    /**
     * Message data
     *
     * @var \Viber\Api\Message
     */
    protected $message;

    /**
     * Get the value of Who send message
     *
     * @return \Viber\Api\Sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Get the value of Message data
     *
     * @return \Viber\Api\Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
