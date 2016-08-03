<?php

namespace JamesHalsall\Hydrator\Tests\Mock;

/**
 * MockObject
 *
 * @package JamesHalsall\Hydrator\Tests\Mock
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class MockObject
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $password;

    /**
     * @param $name
     * @param $emailAddress
     * @param $password
     */
    public function __construct($name = '', $emailAddress = '', $password = '')
    {
        $this->name = $name;
        $this->emailAddress = $emailAddress;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param mixed $email
     */
    public function setEmailAddress($email)
    {
        $this->emailAddress = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
