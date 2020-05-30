<?php

namespace Viber\Api\Event;

use Viber\Api\Event;
use Viber\Api\User;

/**
 * Triggers when a user opens a conversation with the PA using the “message”
 * button (found on the PA’s info screen) or using a deep link.
 *
 * @see https://developers.viber.com/tools/deep-links/index.html
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Conversation extends Event
{
    /**
     * Context information
     *
     * @var string
     */
    protected $context;

    /**
     * Viber user
     *
     * @var User
     */
    protected $user;

    /**
     * Conversation action
     *
     * @var string
     */
    protected $type;

    /**
     * Param "subscribed" is missing in documentation.
     * It's "true" if user was subscribed but delete dialogue without unsubscribe
     *
     * @var bool
     */
    protected $subscribed;

    /**
     * Get the value of Context information
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Get the value of Viber user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get conversation type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isSubscribed()
    {
        return $this->subscribed;
    }
}
