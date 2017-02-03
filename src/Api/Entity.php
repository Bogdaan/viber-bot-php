<?php

namespace Viber\Api;

/**
 * Api entity interface
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Entity
{
    /**
     * Map api-response keys to class setters
     *
     * @var array
     */
    protected $propertiesMap = [];

    /**
     * Make new instance from api response array
     *
     * @param mixed $properties list of properties
     */
    public function __construct($properties = null)
    {
        if (is_null($properties)) {
            return;
        }
        if (!is_array($properties) && !$properties instanceof ArrayAccess) {
            throw new ApiException('Properties must be an array or implement ArrayAccess');
        }
        // call setters
        foreach ($properties as $apiProp => $apiValue) {
            if (isset($this->propertiesMap[$apiProp])) {
                $setterName = $this->propertiesMap[$apiProp];
                $this->$setterName($apiValue);
            }
        }
    }

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
    public function toApiArray()
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
