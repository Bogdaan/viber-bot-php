<?php

namespace Viber\Api\Event;

use Viber\Api\Exception\ApiException;

/**
 * Event factory
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Factory
{
    /**
     * Make some event from api-request array
     *
     * @param  array $data api request data
     * @return \Viber\Api\Event
     */
    public static function makeFromApi(array $data)
    {
        if (isset($data['event'])) {
            switch ($data['event']) {
                case Type::MESSAGE:
                    return new Message($data);
                case Type::SUBSCRIBED:
                    return new Subscribed($data);
                case Type::CONVERSATION:
                    return new Conversation($data);
                case Type::UNSUBSCRIBED:
                    return new Unsubscribed($data);
                case Type::DELIVERED:
                    return new Delivered($data);
                case Type::SEEN:
                    return new Seen($data);
                case Type::FAILED:
                    return new Failed($data);
                case Type::WEBHOOK:
                    return new Webhook($data);
            }
        }
        throw new ApiException('Unknow event data');
    }
}
