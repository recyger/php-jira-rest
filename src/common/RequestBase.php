<?php
namespace recyger\JIRARESTClient\common;

class RequestBase
{
    const METHOD_GET    = 'GET';
    const METHOD_POST   = 'POST';
    const METHOD_PUT    = 'PUT';
    const METHOD_DELETE = 'DELETE';

    private static $_allowedMethod = [self::METHOD_GET, self::METHOD_POST, self::METHOD_PUT, self::METHOD_DELETE];

    private $_url;
    private $_method;
    private $_headers;
    private $_cookies;
    private $_parameters;

    public function __construct(
        string $url,
        string $method = self::METHOD_GET,
        array $parameters = [],
        array $headers = null,
        array $cookies = null
    ) {
        $this->setUrl($url);
        $this->setMethod($method);
        $this->setParameters($parameters);
        $this->setHeaders($headers);
        $this->setCookies($cookies);
    }

    public function getHeaders() : HeadersBase
    {
        return $this->_headers;
    }

    public function setHeaders(array $headers = null)
    {
        if (is_null($headers)) {
            $headers = [];
        }
        $headers['Accept']       = 'application/json';
        $headers['Content-Type'] = 'application/json';
        $this->_headers          = new HeadersBase($headers);
    }

    public function getParameters() : array
    {
        return $this->_parameters;
    }

    public function setParameters(array $parameters)
    {
        $this->_parameters = $parameters;
    }

    public function getUrl() : string
    {
        return $this->_url;
    }

    public function setUrl(string $url)
    {
        if (strpos($url, 'http') !== 0) {
            $url = 'http://' . $url;
        }
        $this->_url = rtrim($url, '/');
    }

    public function getMethod() : string
    {
        return $this->_method;
    }

    public function setMethod(string $method)
    {
        if (!in_array($method, self::$_allowedMethod)) {
            throw new \HttpRequestMethodException();
        }
        $this->_method = strtoupper($method);
    }

    public function getCookies() : CookiesBase
    {
        return $this->_cookies;
    }

    public function setCookies(array $cookies = null)
    {
        if (is_null($cookies)) {
            $cookies = [];
        }
        $this->_cookies = new CookiesBase($cookies);
    }
}
