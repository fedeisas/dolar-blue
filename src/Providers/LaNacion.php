<?php namespace Fedeisas\DolarBlue\Providers;

class LaNacion extends Provider implements ProviderInterface
{
    /**
     * Provider's URL
     * @var string
     */
    protected $url = 'http://contenidos.lanacion.com.ar/json/dolar';

    /**
     * Provider's Default Request Headers
     * @var array
     */
    protected $headers = array();

    /**
     * Parse Provider's Response
     * @param GuzzleHttp\Message\Response $response
     * @return array $result
     */
    public function parse($response)
    {
        $body = (string) $response->getBody();
        $json = json_decode(substr($body, 19, strlen($body) - 19 - 2));

        $buy = number_format(
            preg_replace('/,/', '.', $json->InformalVentaValue),
            2
        );

        $sell = number_format(
            preg_replace('/,/', '.', $json->InformalCompraValue),
            2
        );

        return array(
            'buy' => $buy,
            'sell' => $sell,
            'timestamp' => time(),
        );
    }
}
