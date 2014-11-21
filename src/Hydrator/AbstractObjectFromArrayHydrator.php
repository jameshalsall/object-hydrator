<?php

namespace JamesHalsall\Hydrator;

/**
 * Abstract object from array hydrator
 *
 * @package JamesHalsall\Hydrator
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
abstract class AbstractObjectFromArrayHydrator
{
    /**
     * Get the hydratable class name
     *
     * @param string|callable $className The class name of the model to hydrate for each
     * @param array           $rawData   The raw data to hydrate the data with
     *
     * @return string
     */
    protected function getHydratableClassName($className, $rawData)
    {
        if (is_callable($className)) {
            $hydratableClass = $className($rawData);
        } else {
            $hydratableClass = $className;
        }

        return $hydratableClass;
    }
}
