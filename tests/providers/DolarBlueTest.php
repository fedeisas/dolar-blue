<?php

class DolarBlueTest extends ProviderTestCase
{
    /**
     * @expectedException Exception
     */
    public function testServerNotResponding()
    {
        $this->mockGuzzle('dolarblue/404.txt');
        $result = $this->service->get('DolarBlue');
    }

    /**
     * @expectedException RuntimeException
     */
    public function testMalformedData()
    {
        $this->mockGuzzle('dolarblue/malformed.txt');
        $result = $this->service->get('DolarBlue');
    }

    public function testGoodData()
    {
        $this->mockGuzzle('dolarblue/200.txt');
        $result = $this->service->get('DolarBlue');
        $this->resultAssertions($result);
    }

    public function testMagicMethod()
    {
        $this->mockGuzzle('dolarblue/200.txt');
        $result = $this->service->DolarBlue();
        $this->resultAssertions($result);
    }
}
