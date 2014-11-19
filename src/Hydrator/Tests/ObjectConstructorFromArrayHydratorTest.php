<?php

namespace JamesHalsall\Hydrator\Tests;

use JamesHalsall\Hydrator\ObjectConstructorFromArrayHydrator;

/**
 * ObjectConstructorFromArrayHydrator tests
 *
 * @package JamesHalsall\Hydrator\Tests
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class ObjectConstructorFromArrayHydratorTest extends AbstractHydratorTestCase
{
    /**
     * Setup
     */
    public function setUp()
    {
        $this->sut = new ObjectConstructorFromArrayHydrator();
    }
}
