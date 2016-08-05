<?php

namespace JamesHalsall\Hydrator\Tests;

use JamesHalsall\Hydrator\ObjectSetterFromArrayHydrator;
use JamesHalsall\Hydrator\Tests\Mock\MockObject;

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

    /**
     * @dataProvider getExistingObjectFixtures
     */
    public function testHydrateExistingObject(MockObject $object, MockObject $expectedHydratedObject, array $rawData)
    {
        $hydratedObject= $this->sut->hydrate($object, $rawData);

        $this->assertEquals($expectedHydratedObject, $hydratedObject);
    }

    public function getExistingObjectFixtures()
    {
        return [
            [
                new MockObject('name'),
                new MockObject('name', 'email', 'password'),
                ['email_address' => 'email', 'password' => 'password']
            ]
        ];
    }
}
