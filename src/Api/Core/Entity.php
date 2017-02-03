<?php

namespace Viber\Api\Core;

/**
 * Api entity interface
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Entiy
{
    /**
     * Build array single-level array
     *
     * @return array
     */
    public function toArray()
    {
        return [];
    }

    /**
     * Build multi-level array for api call`s, filter or upgrade properties
     *
     * @return array
     */
    public function toNestedArray()
    {
        $entity = $this->toArray();
        foreach ($entity as $name => &$value) {
            if (is_null($value)) {
                unset($entity[$name]);
            } else if ($value instanceof Entity) {
                $value = $value->toArray();
            }
        }
        return $entity;
    }
}
