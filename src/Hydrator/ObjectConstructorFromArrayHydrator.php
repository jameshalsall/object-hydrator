<?php

namespace JamesHalsall\Hydrator;

use Stringy\Stringy;

/**
 * Object Constructor From Array Hydrator.
 *
 * Hydrates objects using their constructor parameters.
 *
 * @package JamesHalsall\Hydrator
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class ObjectConstructorFromArrayHydrator extends AbstractObjectFromArrayHydrator implements HydratorInterface
{
    /**
     * Hydrates an object with raw data
     *
     * @param string|callable $className The object to hydrate
     * @param array           $rawData   The raw data to hydrate the data with
     *
     * @return mixed
     */
    public function hydrate($className, array $rawData)
    {
        $hydratableClass = $this->getHydratableClassName($className, $rawData);

        $reflectionClass = new \ReflectionClass($hydratableClass);
        $constructorParameters = $reflectionClass->getConstructor()->getParameters();
        $callParameters = array();

        /** @var \ReflectionParameter $parameter */
        foreach ($constructorParameters as $parameter) {
            foreach ($this->getPossibleParameterKeys($parameter) as $possibleKey) {
                if (true === array_key_exists($possibleKey, $rawData)) {
                    $callParameters[] = $rawData[$possibleKey];
                    break;
                }
            }
        }

        if (count($callParameters) !== count($constructorParameters)) {
            return new $hydratableClass();
        }

        return $reflectionClass->newInstanceArgs($callParameters);
    }

    /**
     * Hydrates collection of models.
     *
     * Hydrates an array of models from an array containing multiple arrays
     * of raw data.
     *
     * @param string|callable $className         The class name of the model to hydrate for each
     * @param array           $rawDataCollection The raw data collection
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

    /**
     * Guesses possible raw data keys from a constructor parameter name.
     *
     * @param \ReflectionParameter $parameter The parameter to guess keys for
     *
     * @return array
     */
    private function getPossibleParameterKeys(\ReflectionParameter $parameter)
    {
        $parameterString = new Stringy($parameter->getName());

        return array(
            (string) $parameterString->underscored(),
            // we need to snake case any parameter that has a number in as well (e.g. "alpha2"
            // could be "alpha_2" in the raw data array)
            (string) $parameterString->regexReplace('([a-z]+)([0-9]+)', '\1_\2'),
            $parameter->getName()
        );
    }
} 