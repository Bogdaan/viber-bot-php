<?php

namespace Viber;

use Viber\Api\Core\EventType;

/**
 * Simple rest client for Viber public account (PA)
 *
 * @see https://developers.viber.com/api/rest-bot-api/index.html
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Client
{
    const BASE_URI = 'https://chatapi.viber.com/pa/';

    /**
     * Access token
     *
     * @var string
     */
    protected $token;

    /**
     * http network adapter
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * Create api client, require:
     * token - authentication token
     *
     * @param array $params
     */
    public function __construct($params)
    {
        $this->token = $params['token'];
        $this->http = new \GuzzleHttp\Client([
            'base_uri' => self::BASE_URI,
        ]);
    }


    /**
     * Call api method
     *
     * @param  [type] $method [description]
     * @return mixed
     */
    public function call($method)
    {

    }

    /**
     * Set webhook url.
     *
     * For security reasons only URLs with valid and * official SSL certificate
     * from a trusted CA will be allowed.
     *
     * @param string $url webhook url
     */
    public function setWebhook($url, $eventTypes = null)
    {
        if (is_null($eventTypes)) {
            $eventTypes = [EventType::SUBSCRIBED, EventType::CONVERSATION];
        }
        $response = $this->http->request('POST', 'set_webhook', [
            'json' => [
                'url' => $url,
                'event_types' => $eventTypes,
            ]
        ]);
    }

    /**
     * Fetch the public account’s details as registered in Viber
     *
     * @return array [description]
     */
    public function getAccountInfo()
    {
    }

    /**
     * Fetch the details of a specific Viber user based on his unique user ID.
     *
     * The user ID can be obtained from the callbacks sent to the PA regrading
     * user's actions. This request can be sent twice during a 12 hours period
     * for each user ID.
     *
     * @param  [type] $viberUserId [description]
     * @return [type]         [description]
     */
    public function getUserDetails($viberUserId)
    {
    }

    /**
     * Fetch the online status of a given subscribed PA members.
     *
     * The API supports up to 100 user id per request and those users must be
     * subscribed to the PA.
     *
     * @param  [type] $viberUserIds [description]
     * @return [type]              [description]
     */
    public function getOnlineStatus($viberUserIds)
    {
    }

    /**
     * Send messages to Viber users who subscribe to the PA.
     *
     * @param  [type] $ [description]
     * @return [type]   [description]
     */
    public function sendMessage($message)
    {
    }
}
