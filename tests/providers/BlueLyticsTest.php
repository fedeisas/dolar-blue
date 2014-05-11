<?php

class BlueLyticsTest extends ProviderTestCase
{
    /**
     * @expectedException Exception
     */
    public function testServerNotResponding()
    {
        $this->mockGuzzle('bluelytics/404.txt');
        $result = $this->service->get('BlueLytics');
    }

    /**
     * @expectedException RuntimeException
     */
    public function testMalformedData()
    {
        $this->mockGuzzle('bluelytics/malformed.txt');
        $result = $this->service->get('BlueLytics');
    }

    public function testGoodData()
    {
        $this->mockGuzzle('bluelytics/200.txt');
        $result = $this->service->get('BlueLytics');
        $this->resultAssertions($result);
    }

    public function testMagicMethod()
    {
        $this->mockGuzzle('bluelytics/200.txt');
        $result = $this->service->BlueLytics();
        $this->resultAssertions($result);
    }
}
