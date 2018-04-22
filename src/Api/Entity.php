<?php

namespace Viber\Api;

use Viber\Api\Exception\ApiException;

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
     * @throws \Viber\Api\Exception\ApiException
     */
    public function __construct($properties = null)
    {
        if (null === $properties) {
            return;
        }
        if (!is_array($properties) && !$properties instanceof \ArrayAccess) {
            throw new ApiException('Properties must be an array or implement ArrayAccess');
        }
        if (empty($this->propertiesMap)) { // no property map
            foreach ($properties as $propName => $propValue) {
                if (property_exists(get_class($this), $propName)) {
                    $this->$propName = $propValue;
                }
            }
        } else { // call setters
            foreach ($properties as $propName => $propValue) {
                if (isset($this->propertiesMap[$propName])) {
                    $setterName = $this->propertiesMap[$propName];
                    $this->$setterName($propValue);
                }
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
            if (null === $value) {
                unset($entity[$name]);
            } elseif ($value instanceof Entity) {
                $value = $value->toArray();
            }
        }
        return $entity;
    }
}
