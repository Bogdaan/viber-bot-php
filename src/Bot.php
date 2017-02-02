<?php

namespace Viber;

use Closure;
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
     * Init client, setup acts.
     *
     * Required parameters:
     * authToken - string
     * client - \Viber\Client
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        if (isset($params['authToken'])) {
            $this->client = new Client($params['authToken']);
        } elseif (isset($params['client'])) {
            $this->client = $params['client'];
        } else {
            throw new \RuntimeException('Specify "client" or "authToken" parameters');
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
     * Send message to user
     *
     * @param  \Viber\Api\Message $message [description]
     * @return [type]                   [description]
     */
    public function sendMessage(\Viber\Api\Message $message)
    {
        return $this->client->sendMessage($message);
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
