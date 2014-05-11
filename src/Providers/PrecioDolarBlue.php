<?php namespace Fedeisas\DolarBlue\Providers;

use DomDocument;
use DomXPath;

class PrecioDolarBlue extends Provider implements ProviderInterface
{
    /**
     * Provider's URL
     * @var string
     */
    protected $url = 'http://www.preciodolarblue.com.ar/';

    /**
     * Provider's Default Request Headers
     * @var array
     */
    protected $headers = array(
        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36'
    );

    /**
     * Parse Provider's Response
     * @param GuzzleHttp\Message\Response $response
     * @return array $result
     */
    public function parse($body)
    {
        $body = (string) $body->getBody();

        $dom = new DomDocument();
        $dom->loadHTML($body);

        $xpath = new DomXPath($dom);

        $nodes = $xpath->query(
            "//html/body/div[@class='main']/div[@class='content']" .
            "/div[@class='content_resize']/div[@class='mainbar']" .
            "/div[@class='article']/div/table/tr[1]/td[1]" .
            "/table/tr[2]/td"
        );

        $buy = number_format(
            preg_replace('/,/', '.', $nodes->item(0)->nodeValue),
            2
        );

        $sell = number_format(
            preg_replace('/,/', '.', $nodes->item(1)->nodeValue),
            2
        );

        return array(
            'buy' => $buy,
            'sell' => $sell,
            'timestamp' => time(),
        );
    }
}
