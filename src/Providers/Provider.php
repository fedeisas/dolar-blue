<?php namespace Fedeisas\DolarBlue\Providers;

use \Exception;

abstract class Provider
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $headers;

    /**
     * Returns Provider's URL
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Returns Provider's Default headers
     * @return array $headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
