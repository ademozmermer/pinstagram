<?php

namespace AdemOzmermer\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class Http
{
    private $_options = [];

    /**
     * @param string $method
     * @param string $endpoint
     * @return \Psr\Http\Message\ResponseInterface
     * @throws GuzzleException
     */
    protected function request(string $method, string $endpoint): ResponseInterface
    {
        $client = new Client();
        return $client->request($method, $endpoint, $this->_options);
    }

    /**
     * @param array $headers
     * @return $this
     */
    protected function headers(array $headers): self
    {
        $this->_options = array_merge($this->_options, ['headers' => $headers]);

        return $this;
    }

    /**
     * @param string $proxy
     * @return $this
     */
    protected function proxy(string $proxy): self
    {
        $this->_options['headers']['proxy'] = $proxy;

        return $this;
    }

    /**
     * @param CookieJar|null $cookieJar
     */
    protected function cookies(?CookieJar $cookieJar)
    {
        $this->_options['cookies'] = $cookieJar ?? new CookieJar();
    }

    /**
     * @param array|null $formParam
     * @return $this
     */
    protected function form(?array $formParam): self
    {
        $this->_options['form_params'] = $formParam;

        return $this;
    }
}