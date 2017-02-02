<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Contact as message
 */
class Contact extends Message
{
    /**
     * Name of the contact. Max 28 characters.
     * @var string
     */
    protected $name;

    /**
     * Phone number of the contact. Max 18 characters
     * @var integer
     */
    protected $phone_number;

    /**
     * message type
     * @return [type] [description]
     */
    public function getType()
    {
        return 'contact';
    }
}
