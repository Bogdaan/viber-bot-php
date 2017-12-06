<?php

namespace Viber\Api;

/**
 * Api signature
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Signature
{
    /**
     * Make signature value
     *
     * @param  string $messageBody request body
     * @param  string $token       bot token
     * @return string              signature
     */
    public static function make($messageBody, $token)
    {
        return hash_hmac('sha256', $messageBody, $token);
    }

    /**
     * Is message signatore valid?
     *
     * @param  string  $sign        from request headers
     * @param  string  $messageBody from request body
     * @param  string  $token       bot access token
     * @return boolean              valid or not
     */
    public static function isValid($sign, $messageBody, $token)
    {
        return hash_equals($sign, self::make($messageBody, $token));
    }
}
