<?php

namespace Viber;

use Closure;
use Viber\Client;
use Viber\Bot\Manager;
use Viber\Api\Event;

/**
 * Build bot with viber client
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Bot
{
    /**
     * Client
     *
     * @var \Viber\Client
     */
    protected $client;

    /**
     * Event managers collection
     *
     * @var array
     */
    protected $managers = [];

    /**
     * Init client
     *
     * Required options (one of two):
     * token  string
     * client \Viber\Client
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        if (isset($options['token'])) {
            $this->client = new Client($options);
        } elseif (isset($options['client']) && $options['client'] instanceof Client) {
            $this->client = $options['client'];
        } else {
            throw new \RuntimeException('Specify "client" or "token" parameter');
        }
    }

    /**
     * Get current bot client
     *
     * @return |Viber\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Register event handler callback
     *
     * @param \Closure  $checker checker function
     * @param \Closure  $handler handler function
     *
     * @return \Viber\Bot
     */
    public function on(\Closure $checker, \Closure $handler)
    {
        $this->managers[] = new Manager($checker, $handler);
        return $this;
    }

    /**
     * Register text message handler by PCRE
     *
     * @param  string  $regexp  valid regular expression
     * @param  Closure $handler event handler
     * @return \Viber\Bot
     */
    public function onText($regexp, \Closure $handler)
    {
        $this->managers[] = new Manager(function(Event $event) use ($regexp) {
            return (
                $event instanceof \Viber\Api\Event\Message
                && preg_match($regexp, $event->getMessageText())
            );
        }, $handler);
        return $this;
    }

    /**
     * Register subscrive event handler
     *
     * @param  Closure $handler valid function
     * @return \Viber\Bot
     */
    public function onSubscribe(\Closure $handler)
    {
        $this->managers[] = new Manager(function(Event $event) {
            return ($event instanceof \Viber\Api\Event\Subscribed);
        }, $handler);
        return $this;
    }

    /**
     * Register conversation event handler
     *
     * @param  Closure $handler valid function
     * @return \Viber\Bot
     */
    public function onConversation(\Closure $handler)
    {
        $this->managers[] = new Manager(function(Event $event) {
            return ($event instanceof \Viber\Api\Event\Conversation);
        }, $handler);
        return $this;
    }

    /**
     * Start bot process
     *
     * @return \Viber\Bot
     */
    public function run()
    {
        $eventData = new Event();
        foreach ($this->managers as $manager) {
            if ($manager->isMatch($eventData)) {
                $manager->runHandler($eventData);
                break;
            }
        }
        return $this;
    }
}
