<?php

namespace Viber\Api;

use Viber\Api\Core\ApiException;

/**
 * Manage backend responces, translate api errors ot exceptions
 */
class Response
{
    protected $data;

    public function createFromArray(array $data)
    {
        if (isset($data['status']) && isset($data['status_message'])) {
            if ($data['status'] != 0) {
                throw new ApiException('Remote error: '.$data['status_message'], $data['status']);
            }
            $item = new self();
            $item->data = $data;
            return $item;
        }
        throw new ApiException("Invalid data format");
    }
}
