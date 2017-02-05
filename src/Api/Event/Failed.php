<?php

namespace Viber\Api\Event;

use Viber\Api\Event;

/**
 * Triggers if a message has reached the client but failed any of
 * the client validations.
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Failed extends Event
{
    /**
     * Viber user id
     *
     * @var string
     */
    protected $user_id;

    /**
     * A string describing the failure
     *
     * @var string
     */
    protected $dsc;

    /**
     * Get the value of Viber user id
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the value of A string describing the failure
     *
     * @return string
     */
    public function getDsc()
    {
        return $this->dsc;
    }
}
