<?php

namespace Viber\Api\Event;

use Viber\Api\Event;

/**
 * Triggers when user clicks a subscribe button
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Subscribed extends Event
{
    /**
     * Viber user
     * @var \Viber\Api\User
     */
    protected $user;

    /**
     * Get the value of Viber user
     *
     * @return \Viber\Api\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
