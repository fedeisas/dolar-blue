<?php

class PrecioDolarBlueTest extends ProviderTestCase
{
    /**
     * @expectedException Exception
     */
    public function testServerNotResponding()
    {
        $this->mockGuzzle('preciodolarblue/404.txt');
        $result = $this->service->get('PrecioDolarBlue');
    }

    /**
     * @expectedException RuntimeException
     */
    public function testMalformedData()
    {
        $this->mockGuzzle('preciodolarblue/malformed.txt');
        $result = $this->service->get('PrecioDolarBlue');
    }

    public function testGoodData()
    {
        $this->mockGuzzle('preciodolarblue/200.txt');
        $result = $this->service->get('PrecioDolarBlue');
        $this->resultAssertions($result);
    }

    public function testMagicMethod()
    {
        $this->mockGuzzle('preciodolarblue/200.txt');
        $result = $this->service->PrecioDolarBlue();
        $this->resultAssertions($result);
    }
}
