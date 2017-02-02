<?php

namespace Viber\Api\Core;

/**
 * Api entity interface
 */
interface Entiy
{
    /**
     * Build array for api call`s, filter or upgrade properties
     *
     * @return array
     */
    public function toArray();
}
