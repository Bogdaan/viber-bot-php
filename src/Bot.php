<?php

namespace Viber;

use Closure;
use Viber\Bot\Manager;
use Viber\Api\Event;
use Viber\Api\Signature;
use Viber\Api\Event\Factory;
use Viber\Api\Entity;

/**
 * Build bot with viber client
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Bot
{
    /**
     * Api client
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
     * Signature string
     *
     * @var string
     */
    protected $signature;

    /**
     * Input body
     *
     * @var string
     */
    protected $body;

    /**
     * Init client
     *
     * Required options (one of two):
     * token  string
     * client \Viber\Client
     *
     * @throws \RuntimeException
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

        if (isset($options['signature'])) {
            $this->signature = $options['signature'];
        }

        if (isset($options['body'])) {
            $this->body = $options['body'];
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
     * @param \Closure $checker checker function
     * @param \Closure $handler handler function
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
     * @param  string $regexp valid regular expression
     * @param  Closure $handler event handler
     * @return \Viber\Bot
     */
    public function onText($regexp, \Closure $handler)
    {
        $this->managers[] = new Manager(function (Event $event) use ($regexp) {
            return (
                $event instanceof \Viber\Api\Event\Message
                && $event->getMessage() instanceof \Viber\Api\Message\Text
                && preg_match($regexp, $event->getMessage()->getText())
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
        $this->managers[] = new Manager(function (Event $event) {
            return ($event instanceof \Viber\Api\Event\Subscribed);
        }, $handler);

        return $this;
    }

    /**
     * Register conversation event handler
     *
     * @param Closure $handler valid function
     * @return \Viber\Bot
     */
    public function onConversation(\Closure $handler)
    {
        $this->managers[] = new Manager(function (Event $event) {
            return ($event instanceof \Viber\Api\Event\Conversation);
        }, $handler);

        return $this;
    }

    /**
     * Register picture message handler
     *
     * @param Closure $handler event handler
     * @return \Viber\Bot
     */
    public function onPicture(\Closure $handler)
    {
        $this->managers[] = new Manager(function (Event $event) {
            return (
                $event instanceof \Viber\Api\Event\Message
                && $event->getMessage() instanceof \Viber\Api\Message\Picture
            );
        }, $handler);

        return $this;
    }

    /**
     * Get signature header
     *
     * @throws \RuntimeException
     * @return string
     */
    public function getSignValue()
    {
        $signature = '';
        if ($this->signature !== null) {
            $signature = $this->signature;
        } elseif (isset($_SERVER['HTTP_X_VIBER_CONTENT_SIGNATURE'])) {
            $signature = $_SERVER['HTTP_X_VIBER_CONTENT_SIGNATURE'];
        } elseif (isset($_GET['sig'])) {
            $signature = $_GET['sig'];
        }
        if (empty($signature)) {
            throw new \RuntimeException('Signature not found', 1);
        }

        return $signature;
    }

    /**
     * Get bot input stream
     *
     * @return string
     */
    public function getInputBody()
    {
        return $this->body ?? fopen('php://input', 'r');
    }

    /**
     * Response with entity
     *
     * @param  Entity $entity
     * @return void
     */
    public function outputEntity(Entity $entity)
    {
        header('Content-Type: application/json');
        echo json_encode($entity->toApiArray());
    }

    /**
     * Start bot process
     *
     * @throws \RuntimeException
     * @param \Viber\Api\Event $event start bot with some event
     * @return \Viber\Bot
     */
    public function run($event = null)
    {
        if (null === $event) {
            // check body
            $eventBody = $this->getInputBody();

            if (!Signature::isValid(
                $this->getSignValue(),
                $eventBody,
                $this->getClient()->getToken()
            )) {
                throw new \RuntimeException('Invalid signature', 2);
            }
            // check json
            $eventBody = json_decode($eventBody, true);
            if (json_last_error() || empty($eventBody) || !is_array($eventBody)) {
                throw new \RuntimeException('Invalid json request', 3);
            }
            // make event from json
            $event = Factory::makeFromApi($eventBody);
        } elseif (!$event instanceof Event) {
            throw new \RuntimeException('Event must be instance of \Viber\Api\Event', 4);
        }
        // main bot loop
        foreach ($this->managers as $manager) {
            if ($manager->isMatch($event)) {
                $returnValue = $manager->runHandler($event);
                if ($returnValue && $returnValue instanceof Entity) { // reply with entity
                    $this->outputEntity($returnValue);
                }
                break;
            }
        }

        return $this;
    }
}
