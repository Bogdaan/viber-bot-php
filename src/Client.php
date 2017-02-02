<?php

namespace Viber;

/**
 * Simple rest client for Viber public account
 *
 * @see https://developers.viber.com/api/rest-bot-api/index.html
 */
class Client
{
    /**
     * [__construct description]
     * @param array $params [description]
     */
    public function __construct($params)
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
    public function setWebhook($url)
    {
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
     * @param  [type] $viberUserId [description]
     * @return [type]              [description]
     */
    public function getOnlineStatus($viberUserId)
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
