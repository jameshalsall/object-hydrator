<?php

namespace JamesHalsall\Hydrator;

use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Object From Array Hydrator.
 *
 * Hydrates objects from an array of raw data using their setters.
 * *
 * @package JamesHalsall\Hydrator
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class ObjectSetterFromArrayHydrator extends AbstractObjectFromArrayHydrator implements HydratorInterface
{
    /**
     * Hydrates an object with raw data
     *
     * @param mixed $className The class name of the object to hydrate
     * @param array $rawData   The raw data to hydrate the data with
     *
     * @return mixed
     */
    public function hydrate($className, array $rawData)
    {
        $hydratableClass = $this->getHydratableClassName($className, $rawData);

        $object = new $hydratableClass();
        $propertyAccessor = new PropertyAccessor();
        foreach ($rawData as $property => $value) {
            try {
                $propertyAccessor->setValue($object, $property, $value);
            } catch (NoSuchPropertyException $e) {
                // we don't care about properties in the raw data array that do
                // not exist on the model, so we silently handle this exception
            }
        }

        return $object;
    }

    /**
     * Hydrates collection of models.
     *
     * Hydrates an array of models from an array containing multiple arrays
     * of raw data.
     *
     * @param string $className         The class name of the model to hydrate for each
     * @param array  $rawDataCollection The collection of raw data for the models
     *
     * @return mixed
     */
    public function hydrateCollection($className, array $rawDataCollection)
    {
        $hydratedObjects = array();
        foreach ($rawDataCollection as $rawData) {
            $hydratableClass = $this->getHydratableClassName($className, $rawData);

            $hydratedObjects[] = $this->hydrate($hydratableClass, $rawData);
        }

        return $hydratedObjects;
    }
}
