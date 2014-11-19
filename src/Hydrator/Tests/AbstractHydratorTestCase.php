<?php

namespace JamesHalsall\Hydrator\Tests;

use JamesHalsall\Hydrator\HydratorInterface;
use JamesHalsall\Hydrator\Tests\Mock\MockObject;
use Faker\Factory;

/**
 * AbstractHydratorTestCase
 *
 * @package JamesHalsall\Hydrator\Tests
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class AbstractHydratorTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HydratorInterface
     */
    protected $sut;

    /**
     * @dataProvider getHydrateFixtures
     */
    public function testHydrate($className, $expectedHydratedObject, array $rawData)
    {
        $hydratedObject = $this->sut->hydrate($className, $rawData);

        $this->assertEquals($expectedHydratedObject, $hydratedObject);
    }

    /**
     * @return array
     */
    public function getHydrateFixtures()
    {
        $objectRawData = $this->getRawObjectData();

        return array(
            array(
                'JamesHalsall\Hydrator\Tests\Mock\MockObject',
                new MockObject($objectRawData['name'], $objectRawData['email_address'], $objectRawData['password']),
                $objectRawData
            ),
            array(
                'JamesHalsall\Hydrator\Tests\Mock\MockObject',
                new MockObject($objectRawData['name'], $objectRawData['email_address'], $objectRawData['password']),
                array_merge($objectRawData, array('something-invalid' => 'value'))
            ),
            array('JamesHalsall\Hydrator\Tests\Mock\MockObject', new MockObject(), array())
        );
    }

    /**
     * @dataProvider getHydrateCollectionFixtures
     */
    public function testHydrateCollection($className, $rawData, $expectedHydratedObjects)
    {
        $this->assertEquals($expectedHydratedObjects, $this->sut->hydrateCollection($className, $rawData));
    }

    /**
     * @return array
     */
    public function getHydrateCollectionFixtures()
    {
        $rawData = array(
            $this->getRawObjectData(),
            $this->getRawObjectData(),
            $this->getRawObjectData()
        );

        $expectedHydratedObjects = array(
            new MockObject($rawData[0]['name'], $rawData[0]['email_address'], $rawData[0]['password']),
            new MockObject($rawData[1]['name'], $rawData[1]['email_address'], $rawData[1]['password']),
            new MockObject($rawData[2]['name'], $rawData[2]['email_address'], $rawData[2]['password'])
        );

        return array(
            array(
                'JamesHalsall\Hydrator\Tests\Mock\MockObject',
                $rawData,
                $expectedHydratedObjects
            )
        );
    }

    /**
     * @return array
     */
    protected function getRawObjectData()
    {
        $faker = Factory::create();
        $objectRawData = array('email_address' => $faker->email, 'name' => $faker->name, 'password' => $faker->md5);

        return $objectRawData;
    }
}
