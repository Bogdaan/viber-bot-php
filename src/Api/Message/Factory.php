<?php

namespace Viber\Api\Message;

use Viber\Api\Exception\ApiException;

/**
 * Message factory
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Factory
{
    /**
     * Make certain message from api-request array
     *
     * @param  array $data api request data
     * @return \Viber\Api\Message
     */
    public static function makeFromApi(array $data)
    {
        if (isset($data['type'])) {
            switch ($data['type']) {
                
            }
        }
        throw new ApiException('Unknow message data');
    }
}
