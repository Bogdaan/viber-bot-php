<?php

namespace Viber\Api\Event;

/**
 * Available event types
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
interface Type
{
    const DELIVERED = 'delivered';
    const SEEN = 'seen';
    const FAILED = 'failed';
    const SUBSCRIBED = 'subscribed';
    const UNSUBSCRIBED = 'unsubscribed';
    const CONVERSATION = 'conversation_started';
    const MESSAGE = 'message';
    const WEBHOOK = 'webhook';
}
