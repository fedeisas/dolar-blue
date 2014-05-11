<?php

use Fedeisas\DolarBlue\DolarBlue;
use GuzzleHttp\Client;

class DolarBlueServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Fedeisas\DolarBlue\DolarBlue
     */
    protected $service;

    public function setUp()
    {
        $this->service = new DolarBlue(new Client);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetWrongProvider()
    {
        $result = $this->service->get('WrongProvider');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetAbstractProvider()
    {
        $result = $this->service->get('Provider');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testBadMagicMethod()
    {
        $result = $this->service->Provider();
    }
}
