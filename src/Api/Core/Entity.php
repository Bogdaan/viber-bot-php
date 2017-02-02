<?php

namespace Viber\Api\Core;

/**
 * Api entity interface
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
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
