<?php

namespace Viber\Bot;

use \Viber\Api\Event;

/**
 * Bot event manager.
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Manager
{
    /**
     * Check if we trigger handler
     *
     * @var \Closure
     */
    protected $checker;

    /**
     * Handler function
     *
     * @var \Closure
     */
    protected $handler;

    /**
     * Create new event manager (event checker and event handler)
     *
     * @param  Closure $checker
     * @param  Closure $handler
     */
    public function __construct(\Closure $checker, \Closure $handler)
    {
        $this->checker = $checker;
        $this->handler = $handler;
    }

    /**
     * Get the value of Check if we trigger handler
     *
     * @return \Closure
     */
    public function getChecker()
    {
        return $this->checker;
    }

    /**
     * Get the value of Handler function
     *
     * @return \Closure
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * While event checker match current event?
     *
     * @param  \Viber\Api\Event $event
     * @return boolean
     */
    public function isMatch(Event $event)
    {
        if (is_callable($this->checker)) {
            return call_user_func($this->checker, $event);
        }
        return false;
    }

    /**
     * Process event with handler function
     *
     * @param  \Viber\Api\Event $event
     * @return mixed event handler result
     */
    public function runHandler(Event $event)
    {
        if (is_callable($this->handler)) {
            return call_user_func($this->handler, $event);
        }
        return false;
    }
}
