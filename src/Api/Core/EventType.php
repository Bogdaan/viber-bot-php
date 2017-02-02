<?php

namespace Viber\Api\Core;

/**
 * Available event types
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
interface EventType
{
    const DELIVERED = "delivered";
    const SEEN = "seen";
    const FAILED = "failed";
    const SUBSCRIBED = "subscribed";
    const UNSUBSCRIBED = "unsubscribed";
    const CONVERSATION = "conversation_started";
}
