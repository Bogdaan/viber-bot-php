<?php

namespace Viber;

use Viber\Api\Core\EventType;
use Viber\Api\Message;

/**
 * Simple rest client for Viber public account (PA)
 *
 * @see https://developers.viber.com/api/rest-bot-api/index.html
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Client
{
    /**
     * Api endpoint base
     *
     * @var string
     */
    const BASE_URI = 'https://chatapi.viber.com/pa/';

    /**
     * Access token
     *
     * @var string
     */
    protected $token;

    /**
     * Http network client
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * Create api client. Options:
     * token  required  string  authentication token
     * http   optional  array   adapter parameters
     *
     * @throws \Viber\Exception\ViberException
     * @param array $options
     */
    public function __construct($options)
    {
        if (!isset($options['token'])) {
            throw new ViberException('No token provided');
        }
        $this->token = $options['token'];
        $httpInit = [
            'base_uri' => self::BASE_URI,
        ];
        if (isset($param['http']) && is_array($param['http'])) {
            $httpInit = array_merge($param['http'], $httpInit);
        }
        $this->http = new \GuzzleHttp\Client($httpInit);
    }

    /**
     * Call api method
     *
     * @throws \Viber\Api\Core\ApiException
     * @param  string $method method name
     * @param  mixed  $data   method data
     * @return \Viber\Api\Response
     */
    public function call($method, array $data)
    {
        try {
            $response = $this->http->request('POST', $method, [
                'json' => $data
            ]);
            return Viber\Api\Response::create($response, $this->token);
        } catch (\RuntimeException $e) {
            throw new Viber\Api\Core\ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Set webhook url.
     *
     * For security reasons only URLs with valid and * official SSL certificate
     * from a trusted CA will be allowed.
     *
     * @see \Viber\Api\Core\EventType
     * @throws \Viber\Api\Core\ApiException
     * @param string     $url          webhook url
     * @param array|null $eventTypes   subscribe to certain events
     */
    public function setWebhook($url, $eventTypes = null)
    {
        if (is_null($eventTypes)) {
            $eventTypes = [EventType::SUBSCRIBED, EventType::CONVERSATION];
        }
        return $this->call('set_webhook', [
            'url' => $url,
            'event_types' => $eventTypes,
        ]);
    }

    /**
     * Fetch the public account’s details as registered in Viber
     *
     * @throws \Viber\Api\Core\ApiException
     * @return \Viber\Api\Response
     */
    public function getAccountInfo()
    {
        return $this->call('get_account_info', []);
    }

    /**
     * Fetch the details of a specific Viber user based on his unique user ID.
     *
     * The user ID can be obtained from the callbacks sent to the PA regrading
     * user's actions. This request can be sent twice during a 12 hours period
     * for each user ID.
     *
     * @throws \Viber\Api\Core\ApiException
     * @param string $userId
     * @return \Viber\Api\Response
     */
    public function getUserDetails($userId)
    {
        return $this->call('get_user_details', [
            'id' => $userId
        ]);
    }

    /**
     * Fetch the online status of a given subscribed PA members.
     *
     * The API supports up to 100 user id per request and those users must be
     * subscribed to the PA.
     *
     * @throws \Viber\Api\Core\ApiException
     * @param  array $userIds list of user ids
     * @return \Viber\Api\Response
     */
    public function getOnlineStatus(array $userIds)
    {
        return $this->call('get_online', [
            'ids' => $userIds
        ]);
    }

    /**
     * Send messages to Viber users who subscribe to the PA.
     *
     * @param  \Viber\Api\Message $message
     * @return \Viber\Api\Response
     */
    public function sendMessage(Message $message)
    {
        return $this->call('send_message', $message->toNestedArray());
    }
}
