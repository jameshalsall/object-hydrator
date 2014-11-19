<?php

namespace JamesHalsall\Hydrator\Tests;

use JamesHalsall\Hydrator\ObjectSetterFromArrayHydrator;

/**
 * ObjectSetterFromArrayHydrator tests
 *
 * @package JamesHalsall\Hydrator\Tests
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class ObjectSetterFromArrayHydratorTest extends AbstractHydratorTestCase
{
    /**
     * Setup
     */
    public function setUp()
    {
        $this->sut = new ObjectSetterFromArrayHydrator();
    }
}
