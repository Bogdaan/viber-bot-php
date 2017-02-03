<?php

namespace Viber\Api;

use Viber\Api\Core\ApiException;

/**
 * Manage backend response,
 * translate api error ot exception,
 * validate message token
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Response
{
    /**
     * Raw response data
     *
     * @var array
     */
    protected $data;

    /**
     * Create api response from http-response
     *
     * @param  \GuzzleHttp\Psr7\Response $response network response
     * @param  string                    $token    PA token
     * @return \Viber\Api\Response
     */
    public static function create(GuzzleHttp\Psr7\Response $response, $token)
    {
        // - validate token
        $authHeader = $response->getHeader('X-Viber-Content-Signature');
        if (!$authHeader || $authHeader != hash_hmac('sha256', $response->getBody(), $token)) {
            throw new ApiException("Invalid X-Viber-Content-Signature");
        }
        // - validate body
        $data = json_decode($response->getBody(), true);
        if (empty($data)) {
            throw new ApiException("Invalid response body");
        }
        // - validate internal data
        if (isset($data['status']) && isset($data['status_message'])) {
            if ($data['status'] != 0) {
                throw new ApiException('Remote error: '.$data['status_message'], $data['status']);
            }
            $item = new self();
            $item->data = $data;
            return $item;
        }
        throw new ApiException("Invalid response json");
    }

    /**
     * Get the value of Raw response data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
