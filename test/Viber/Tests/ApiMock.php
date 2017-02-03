<?php

namespace Viber\Tests;

/**
 * Api response arrays
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class ApiMock
{
    // response array samples
    protected $callList = [
        'set_webhook' => [
            "url" => "https://my.host.com",
            "event_types" => ["delivered", "seen", "failed", "subscribed", "unsubscribed", "conversation_started"]
       ],
       'get_account_info' => [
            "status" => 0,
            "status_message" => "ok",
            "id" => "pa:75346594275468546724",
            "name" => "account name",
            "uri" => "accountUri",
            "icon" => "http://example.com",
            "background" => "http://example.com",
            "category" => "category",
            "subcategory" => "sub category",
            "location" => [
               "lon" => 0.1,
               "lat" => 0.2
            ],
            "country" => "UK",
            "webhook" => "https://my.site.com",
            "event_types" => ["delivered", "seen"],
            "subscribers_count" => 35,
            "members" => [
                [
                   "id" => "01234567890A=",
                   "name" => "my name",
                   "avatar" => "http://example.com",
                   "role" => "admin"
                ]
            ]
       ],
       'get_user_details' => [
            "status" => 0,
            "status_message" => "ok",
            "message_token" => 4912661846655238145,
            "user" => [
                "id" => "01234567890A=",
                "name" => "John McClane",
                "avatar" => "http://avatar.example.com",
                "country" => "UK",
                "language" => "en",
                "primary_device_os" => "android 7.1",
                "api_version" => 1,
                "viber_version" => "6.5.0",
                "mcc" => 1,
                "mnc" => 1
            ]
       ],
       'get_online' => [
            "status" => 0,
            "status_message" => "ok",
            "users" => [[
                "id" => "01234567890=",
                "online_status" => 0,
                "online_status_message" => "online"
            ], [
                "id" => "01234567891=",
                "online_status" => 1,
                "online_status_message" => "offline",
                "last_online" => 1457764197627
            ], [
                "id" => "01234567892=",
                "online_status" => 2,
                "online_status_message" => "undisclosed"
            ], [
                "id" => "01234567893=",
                "online_status" => 3,
                "online_status_message" => "tryLater"
            ], [
                "id" => "01234567894=",
                "online_status" => 4,
                "online_status_message" => "unavailable"
            ]]
       ],
       'post' => [
           "from" => "01234567890A=",
            "sender" => [
                "name" => "Yarden from the PA",
                "avatar" => "http://avatar.example.com"
            ],
            "type" => "text",
            "text" => "a message from pa"
       ],
       'send_message' => [
            "receiver" => "01234567890A=",
            "min_api_version" => 1,
            "sender" => [
                "name" => "John McClane",
                "avatar" => "http://avatar.example.com"
            ],
            "tracking_data" => "tracking data",
            "type" => "text",
            "text" => "a message from pa"
       ]
    ];


    /**
     * Find mock by method name
     */
    public static function getMockByName($name)
    {
        if (isset($this->callList[$name])) {
            return $this->callList[$name];
        }
        return [];
    }
}
