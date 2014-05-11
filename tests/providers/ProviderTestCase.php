<?php

use Fedeisas\DolarBlue\DolarBlue;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;

abstract class ProviderTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var Fedeisas\DolarBlue\DolarBlue
     */
    protected $service;

    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = new Client;
        $this->service = new DolarBlue($this->client);
    }

    /**
     * Mock Guzzle response with file response
     * @param string $response
     * @return void
     */
    public function mockGuzzle($response)
    {
        $this->client = new Client;

        $mock = new Mock(array(
            file_get_contents(__DIR__ . '/fixtures/' . $response)
        ));

        $this->client->getEmitter()->attach($mock);

        $this->service = new DolarBlue($this->client);
    }

    /**
     * Common assertions for every provider's test
     * @param array $result
     */
    public function resultAssertions($result)
    {
        $this->assertArrayHasKey('sell', $result);
        $this->assertArrayHasKey('buy', $result);
        $this->assertArrayHasKey('timestamp', $result);
        $this->assertEquals($result['buy'], 10.50);
        $this->assertEquals($result['sell'], 10.50);
    }
}
