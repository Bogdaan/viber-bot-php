<?php

namespace Viber\Api;

/**
 * Viber general message object
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Message
{
    /**
     * Viber user
     * @var [type]
     */
    protected $receiver;

    /**
     * Message type
     * @var [type]
     */
    protected $type;

    /**
     * Sender information
     * @var [type]
     */
    protected $sender;

    /**
     * Allow PA to track messages and user’s replies.
     * Passed back with user’s reply
     * @var string
     */
    protected $tracking_data;

    /**
     * API version required by clients
     * @var integer
     */
    protected $min_api_version = 1;


    public function __construct($params)
    {
        $this->type = $this->getType();
    }
}
