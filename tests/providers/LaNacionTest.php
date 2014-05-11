<?php

class LaNacionTest extends ProviderTestCase
{
    /**
     * @expectedException Exception
     */
    public function testServerNotResponding()
    {
        $this->mockGuzzle('lanacion/404.txt');
        $result = $this->service->get('LaNacion');
    }

    /**
     * @expectedException RuntimeException
     */
    public function testMalformedData()
    {
        $this->mockGuzzle('lanacion/malformed.txt');
        $result = $this->service->get('LaNacion');
    }

    public function testGoodData()
    {
        $this->mockGuzzle('lanacion/200.txt');
        $result = $this->service->get('LaNacion');
        $this->resultAssertions($result);
    }

    public function testMagicMethod()
    {
        $this->mockGuzzle('lanacion/200.txt');
        $result = $this->service->LaNacion();
        $this->resultAssertions($result);
    }
}
