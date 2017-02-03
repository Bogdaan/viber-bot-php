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
                case Type::TEXT:
                    return new Text($data);
                case Type::URL:
                    return new Url($data);
                case Type::PICTURE:
                    return new Picture($data);
                case Type::CONTACT:
                    return new Contact($data);
                case Type::VIDEO:
                    return new Video($data);
                case Type::FILE:
                    return new File($data);
                case Type::STICKER:
                    return new Sticker($data);
                case Type::LOCATION:
                    return new Location($data);
            }
        }
        throw new ApiException('Unknow message data');
    }
}
