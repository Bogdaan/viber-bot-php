<?php

namespace Viber\Api\Event;

use Viber\Api\Event;

/**
 * Triggers when message delivered from Viber Backend to user device
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Delivered extends Event
{
    /**
     * Viber user id
     * @var integer
     */
    protected $user_id;

    /**
     * Get the value of Viber user id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }
 
}
