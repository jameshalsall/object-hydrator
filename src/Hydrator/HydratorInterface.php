<?php

namespace JamesHalsall\Hydrator;

/**
 * Hydrator Interface.
 *
 * Hydrators are responsible for taking some scalar data and populating
 * an object with that data.
 *
 * @package JamesHalsall\Hydrator
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
interface HydratorInterface
{
    /**
     * Hydrates an object with raw data
     *
     * @param string|callable $class The class name of the object to hydrate
     * @param array           $rawData   The raw data to hydrate the data with
     *
     * @return mixed
     */
    public function hydrate($class, array $rawData);

    /**
     * Hydrates an array of objects from an array containing multiple arrays
     * of raw data.
     *
     * @param string|callable $className         The class name of the model to hydrate for each
     * @param array           $rawDataCollection The collection of raw data for the models
     *
     * @return mixed
     */
    public function hydrateCollection($className, array $rawDataCollection);
}
