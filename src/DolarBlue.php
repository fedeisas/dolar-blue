<?php namespace Fedeisas\DolarBlue;

use Fedeisas\DolarBlue\Providers\ProviderInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use ReflectionClass;
use ReflectionException;
use InvalidArgumentException;
use Exception;
use RuntimeException;

class DolarBlue
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Instance provider, fetch endpoint, and returns provider's parsed result
     * @param string $provider Provider's name. Default LaNacion
     * @throws InvalidArgumentException If unknown provider
     * @throws Exception If can't parse result
     * @return array Result set.
     */
    public function get($provider = 'LaNacion')
    {
        $className = 'Fedeisas\DolarBlue\Providers\\' . $provider;

        $providerInstance = $this->getProviderInstance($provider);

        $result = $this->fetch($providerInstance);

        return $result;
    }

    /**
     * Check if is a valid provider and return instance
     * @param string $provider
     * @return Fedeisas\DolarBlue\Providers\ProviderInterface $providerInstance
     */
    private function getProviderInstance($provider)
    {
        $className = 'Fedeisas\DolarBlue\Providers\\' . $provider;

        try {
            $reflection = new ReflectionClass($className);
        } catch (ReflectionException $e) {
            throw new InvalidArgumentException('Unknown provider: ' . $provider);
        }

        if (!$reflection->isInstantiable()) {
            throw new InvalidArgumentException('Unknown provider: ' . $provider);
        }

        $providerInstance = new $className;

        return $providerInstance;
    }

    /**
     * Fetch Provider's response using Guzzle and parse
     * response with Provider's custom method
     * @param ProviderInterface $provider
     * @return array $results
     */
    private function fetch(ProviderInterface $providerInstance)
    {
        try {
            $request = $this->client->get(
                $providerInstance->getUrl(),
                [
                    'headers' => $providerInstance->getHeaders()
                ]
            );

            $result = $providerInstance->parse($request);
        } catch (BadResponseException $e) {
            throw new Exception('Server not responding.');
        } catch (Exception $e) {
            throw new RuntimeException('Malformed response.');
        }

        return (array) $result;
    }

    /**
     * Magic method for calling providers
     * @param string $method
     * @param array $attributes
     * @return array Result set.
     */
    public function __call($method, $attributes = array())
    {
        return $this->get($method);
    }
}
